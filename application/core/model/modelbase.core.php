<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/
define('DB_PAGESIZE',20);

class ModelBase extends Object{
	public $_name = '';
	public $_tablename = ''; 
	public $_realtablename = '';
	public $_db_config = '';
	
	public $_id_field = 'id';
	
	/* 关联模型指定 */
	public $_relations = array();
	
	/** 数据合法性校验  */
	public $_validation = array();
	public $_validation_msgs = array();
	/**
	 * 
	 * @var CI_DB_mysqli_driver
	 */
	protected $db = NULL;
	protected $dbutil = NULL;
	/**
	 * @var AppBase
	 */
	public $cc;
	
	public function __construct(){
		parent::__construct();
		$this->_init_model();
	}
	
	private function _init_model(){
		$this->_db_config = cc()->config->get('','db');
		$this->_realtablename = $this->_filterTableName();
	}
	
	/** 数据库链接 
	 * @return  CI_DB_mysqli_driver | CI_DB_driver
	 */
	public function &db(){
		if($this->db === NULL){
			require_once CORE_PATH . '/model/db/DB.php';
			$conf = $this->_db_config;$conf['dbprefix'] = '';
			$this->db =& DB($conf);
			if(!$this->db){
				$this->_error('No database driver:'.$this->_db_config['dbdriver']);
				return false;
			}
		}
		return $this->db;
	}
	/** 数据库工具链接 */
	public function &dbutil($db = NULL){
		if($this->dbutil === NULL){
			require_once CORE_PATH . '/model/db/DB_utility.php';
			$class = 'CI_DB_utility';
			$driver = $this->_db_config['dbdriver'];
			$file = CORE_PATH . '/model/db/drivers/' . $driver . '/' . $driver . '_utility.php';
			if(is_file($file)){
				require_once $file;
				$class = 'CI_DB_' . $driver . '_utility';
			}
			if(!$db){
				$db = $this->db();
			}
			$this->dbutil = new $class($db);
		}
		return $this->dbutil;
	}
	
	/** 字段列,用于做数据输入输出过滤、格式转换等,在子模型中复写返回 */
	public function columns(){
		return array();
	}
	
	public function _filterTableName($name=''){
		$pre = $this->_db_config['dbprefix'];
		$name = $name?$name:($this->_tablename?$this->_tablename:$this->_name);
		$name = preg_replace('/^'.$pre.'/','',$name);
		return $pre . $name;
	}
	
	private function _filterAlias($str,$a='A'){
		$a = stripos(trim($str),'.') === false? ($a . '.'):'';
		return $a . $str;
	}
	/** 标准化参数 */
	private function _filterParams($parms=array()){
		$parms = array_merge(array(
					'fields'=>'*',
					'join'	=>'',
					'where'=>null,
					'order_by'=>null,
					'group_by'=>null,
					'page'=>1,
					'from'=>$this->_realtablename,
					'pagesize'=>DB_PAGESIZE
				),$parms);
		$parms['page'] = intval($parms['page']);
		$parms['pagesize'] = intval($parms['pagesize']);
		$parms['join'] = $this->_filterJoins($parms['join']);
		//如果有关联表，则处理未使用别名的字段
		if($parms['join']){
			$fields = is_array($parms['fields'])?$parms['fields']:explode(',', $parms['fields']);
			foreach($fields as $k=>$v){
				$fields[$k] = $this->_filterAlias($v);
			}
			$parms['fields'] = implode(',',$fields);
		}
		$parms['from'] .= ' A';
		/* 标准化 */
		$parms['select'] = $parms['fields'];
		if($parms['page']>0){
			$offset = ($parms['page'] -1 ) * $parms['pagesize'];
			$parms['limit'] = array($parms['pagesize'],$offset);
		}
		return $parms;
	}
	/** 标准化关联表参数 **/
	private function _filterJoins($joins=''){
		if(!$joins) return false;
		$ret = array();
		$joins = explode(',',$joins);
		foreach($joins as $k=>$v){
			if(isset($this->_relations[$v])){
				$rel = $this->_relations[$v];
				$ret[$k] = array(
						$this->_filterTableName($rel['table']) . ' ' . $rel['alias'],
						$rel['on'],
						strtolower($rel['type'])
					);
			}
		}
		return empty($ret)?false:$ret;
	}
	/** Active Record 类查询 */
	public function query($parms=array()){
		/* 参数标准化 */
		$parms = $this->_filterParams($parms);
		
		$methods = array('select','from','where','group_by','order_ty','limit');
		$db =& $this->db();
		
		$db->select($parms['select']);
		$db->from($parms['from']);
		if($parms['where']){
			foreach($parms['where'] as $k=>$v){
				$k = $this->_filterAlias($k);
				if(is_array($v)) $db->where_in($k,$v);
				else $db->where($k,$v);
			}	
		}
		if($parms['group_by'])	$db->group_by($parms['group_by']);
		if($parms['order_by'])	$db->order_by($parms['order_by']);
		if($parms['limit'])		$db->limit($parms['limit'][0],$parms['limit'][1]);
		
		/* 关联表 */
		if($parms['join']){
			foreach($parms['join'] as $k=>$join){
				call_user_func_array(array($db,'join'), $join);
			}
		}
		$query = $db->get();
		return $query;
	}
	
	/** 获取批量数据 */
	public function get_list($parms=array()){
		$query = $this->query($parms);
		$result = $query->result_array();
		return empty($result)?array():$result;
	}
	
	/** 获取一条数据  */
	public function get_one($parms=array()){
		$parms['page']=1;$parms['pagesize']=1;
		$query = $this->query($parms);
		$result = $query->row_array();
		return empty($result)?false:$result;
	}
	/** 获得总计数量 **/
	public function get_count($parms=array()){
		$ps = array('fields'=>'COUNT(A.'.$this->_id_field .') AS c');
		isset($parms['join']) && $ps['join'] = $parms['join'];
		isset($parms['where']) && $ps['where'] = $parms['where'];
		$result = $this->query($ps)->row_array();
		return empty($result)?0:intval($result['c']);
	}
	/** 新增数据 */
	public function add($data){
		if(empty($data)) return false;
		$db =& $this->db();
		$res = $db->insert($this->_realtablename,$data);	
		return $res?$db->insert_id():false;
	}
	/** 编辑数据 */
	public function edit($data,$where){
		if(empty($data)) return false;
		$db =& $this->db();
		$res = $db->update($this->_realtablename,$data,$where);
		return $res?$db->affected_rows():false;
	}
	/** 删除数据  */
	public function delete($where){
		if(empty($where)) return false;
		$db =& $this->db();
		$res = $db->delete($this->_realtablename,$where);
		return $res?$db->affected_rows():false;
	}
	
	/**
	 * 
	 * @param Boolean|WL_Error $data
	 */
	public function valid_data($data,$fields=array()){
		if(empty($data)) return false;
		$vd =& cc()->load->lib('validation');
		$rules = $this->_validation;
		if(empty($fields)){
			$rules = $this->_validation;
		}else{
			foreach($fields as $i=>$f){
				$rules[$f] = isset($this->_validation[$f])?$this->_validation[$f]:array();
			}
		}
		$ret = $vd->valid($data,$rules,$this->_validation_msgs,false);
		return $ret?true:wl_error('valid_failed', $vd->get_valid_msg());
	}
	/**
	 * 获得最近一次执行的sql语句
	 */
	public function last_query(){
	    return $this->db()->last_query();
	}
	
	
	
	
}