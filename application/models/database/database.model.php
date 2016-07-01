<?php
/**
* 数据库管理工具
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-13
*/
class DatabaseModel extends ModelBase{
	var $_name ='database';
	var $_tablename = '';
	var $_datapath = '';
	
	function __construct($data_path = ''){
		parent::__construct();
		$this->_datapath = APP_PATH . '/' .($data_path?trim($data_path,'/'):'data') . '/dbbackup';
		
		
	}
	/* 表列表 */
	function columns(){
		$ret = array(
				'name'		=>	array('name' => 'table_name', 'display' => 'column_names.table_name', 'align' => 'center', 'width' => 200),
				'last_date'	=>	array('name' => 'last_date', 'display' => 'column_names.last_date', 'align' => 'center', 'width' => 120,'hidden'=>true),
				'operation'	=>	array('name' => 'operation', 'display' => 'column_names.operation', 'align' => 'center', 'width' => 120),			
			);
		return $ret;
	}
	
	/* 已备份列表 */
	function bkColumns(){
		$ret = array(
				'date'		=>	array('name' => 'date', 'display' => 'bkcolumn_names.date', 'align' => 'center', 'width' => 150),
				'time'		=>	array('name' => 'time', 'display' => 'bkcolumn_names.time', 'align' => 'center', 'width' => 150),
				'tables'	=>	array('name' => 'tables', 'display' => 'bkcolumn_names.tables', 'align' => 'center', 'width' => 120,'hidden'=>true),
				'size'		=>	array('name' => 'size', 'display' => 'bkcolumn_names.size', 'align' => 'center', 'width' => 120,'hidden'=>true),
				'operation'	=>	array('name' => 'operation', 'display' => 'column_names.operation', 'align' => 'center', 'width' => 120),
		);
		return $ret;
	}
	/** 数据表数据 */
	function getList(){
		$list = $this->db()->list_tables();
		$ret = array();
		foreach($list as $i=>$name){
			$ret[] = array(
				'table_name'=>$name,
				'last_date'	=>	''
			);
		}
		return $ret;
	}
	
	/* 遍历数据文件夹，获得所有备份文件列表 */
	function _scanPath(){
		$path = $this->_datapath . '/';
		$hd = opendir($path);
		$list = array();
		while(($dir = readdir($hd))!==false){
			if(!is_dir($path.$dir)||$dir =='.' || $dir == '..'){continue;}
			if(!preg_match('/2\d{3}_\d{1,2}_\d{1,2}/',$dir)){continue;}
			$date = date('Y-m-d',strtotime(str_replace('_','-',$dir)));
			$list[$date]=array();
			/* 获取文件夹下的备份文件列表 */
			$fh = opendir($path.$dir);
			while(($f = readdir($fh)) !== false){
				if(preg_match('/^(\d+)\.(.+)\.sql$/', $f,$ms)){
					$time = date('H:i:s',strtotime($ms[1]));
					$list[$date][$time] = array(
								'time'=>$time,
								'tables'=>$ms[2],
								'file'=>$path.$dir.'/'.$f,
								'size'=>filesize($path.$dir.'/'.$f)
							);
				}
			}
			!empty($list[$date]) &&krsort($list[$date]);
		}
		krsort($list);
		return $list;
	}
	
	/** 数据库备份列表  */
	function getBackUpList(){
		$list = $this->_scanPath();
		$ret = array();$id=0;
		foreach ($list as $date=>$v){
			foreach($v as $time=>$arr){
				$arr['date'] = $date;
				$arr['id'] = $id++;
				$ret[] = $arr;
			}	
		}
		return $ret;
	}
	
	/* 创建备份 */
	function doBackup($tables=array()){
		!$tables && $tables = array();
		is_string($tables) && $tables = explode(',', $tables);
		$type = empty($tables)?'all':count($tables) . 'tables';
		$date = date('Y_m_d');
		$time = date('His');
		$file = $this->_datapath . '/' . $date . '/' . $time . '.' . $type . '.sql';
		@wl_mkdir(dirname($file));
		$this->dbutil()->backup(array(
					'tables'=>$tables,
					'filename'=>$file,
					'format'=>'txt'
				));
		return true;
	}
	
	
	
}