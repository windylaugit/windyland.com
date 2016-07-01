<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-9
*/
class ColumnModel extends ModelBase{
	var $_name ='column';
	var $_tablename = 'column';
	public $_id_field = 'c_id';
	
	
	public $_relations = array(
				'has_one_type' => array(
						'table'	=>	'contents_type',
						'alias'	=>	'B',
						'on'	=>	'A.ctype_id = B.ctype_id',
						'type'	=>	C::MODEL_RE_TYPE_LEFT,	
					)			
			);
	
	public $_validation = array(
				'c_name'	=>	array(
							'required'	=>	true,
							'maxlength'	=>	6,
							'minlength'	=>	2
						),
				'alias'		=>	array(
							'required'	=>	true,
							'maxlength'	=>	8,
							'minlength'	=>	2
						),
				'parent_id'	=>	array(
							'required'	=>	true,
							'digits'	=>	true
						),
				'sort_order'=>	array(
							'required'	=>	true,
							'digits'	=>	true,
							'max'		=>	255,
							'min'		=>	1	
						)
			);
	public $_validation_msg = array(
				
			
			);
	
	function columns(){
		$ret = array(
				'id'		=>	array('name' => 'c_id', 'display' => 'ID', 'align' => 'center', 'width' => 100),
				'name'		=>	array('name' => 'c_name', 'display' => 'c_name', 'align' => 'center', 'width' => 100),
				'parent_id'	=>	array('name' => 'parent_id', 'display' => 'parent_id', 'align' => 'center', 'width' => 100,'hidden'=>true),
				'ctype'		=>	array('name' => 'ctype', 'display' => 'ID', 'align' => 'center', 'width' => 100),
				'sort_order'=>	array('name' => 'id', 'display' => 'ID', 'align' => 'center', 'width' => 100),
				
			);
		
	}
	/* 栏目列表 */
	function getList($parent_id=0,$ctype=0,$page=1,$pagesize=20){
		$parms = array(
					'page'=>$page,
					'pagesize'=>$pagesize,
					'join'=>'has_one_type',
					'order_by'	=>	'c_id'
				);
		$where = array();
		$parent_id && $where['parent_id'] = $parent_id;
		$ctype && $where['ctype_id'] = $ctype;
		!empty($where) && $parms['where'] = $where;
		$list = $this->get_list($parms);
		
		return $list;
	}
	/** 对栏目列表排序 */
	function orderList($list){
		$getSons = function($list,$pid,$lv=0)use(&$getSons){
			$_sons=array();$_list = array();$ret = array();
			foreach ($list as $k=>$v){
				$v['level'] = $lv;
				if($v['parent_id'] == $pid){
					$_sons[] = $v;
				}else{
					$_list[] = $v;
				}
			}
	
			if(!empty($_sons)){
	
				/* 同级先按sort_order、ID排序 */
				uasort($_sons, function($a,$b){
					$sa = intval($a['sort_order']);
					$sb = intval($b['sort_order']);
					if($sa === $sb){
						return intval($a['c_id']) > intval($b['c_id'])?1:-1;
					}else{
						return $sa>$sb?1:-1;
					}
				});
				foreach($_sons as $k=>$v){
					$ret[] = $v;
					if(!empty($_list)){
						$_sons_sons = $getSons($_list,$v['c_id'],$lv+1);
						$ret = array_merge($ret,$_sons_sons);
					}
				}
	
			}
			return $ret;
		};
		return $getSons($list,0,0);
	}
	/** 获得排序过的栏目列表 */
	function getOrderedList($parent_id=0,$ctype=0,$page=1,$pagesize=20){
		$list = $this->getList($parent_id,$ctype,$page,$pagesize);
		$list = $this->orderList($list);
		return $list;	
	}
	
	
	/* 根据条件获取一个栏目 */
	function getColumn($where=array()){
		if(!is_array($where)) $where = array($this->_id_field=>$where);
		$ret = $this->get_one(array(
					'where'	=>	$where
				));
		return empty($ret)?false:$ret;
	}
	/**
	 * 获取某个栏目的祖先栏目
	 * @param int $c_id
	 */
	function getAncestors($pid){
		$ret = array();
		if(!$pid) return $ret;
		$list = array();
		foreach($this->getList(0,0,1,100) as $k=>$v){
			$list[$v['c_id']] = $v;	
		}
		while($pid && isset($list[$pid])){
			array_unshift($ret, $list[$pid]);
			$pid = $list[$pid]['parent_id'];
		}
		return $ret;
	}
	
	
	
}