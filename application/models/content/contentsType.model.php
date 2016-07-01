<?php
/**
* 内容类型模块
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-9
*/
class ContentsTypeModel extends ModelBase{
	var $_name ='contentsType';
	var $_tablename = 'contents_type';
	
	public $_relations = array();
	
	function columns(){
		
	}
	
	function getList(){
		$key = 'contents_type_list';
		$data = cc()->cache->get($key);
		if(!$data){
			$data = $this->get_list();
			cc()->cache->set($key,$data,0);
		}
		return $data;
	}
	
	function getId($key=''){
		$ret = '';
		$list = $this->getList();
		foreach($list as $k=>$v){
			if($v['ctype_key'] == $key) $ret = $v['ctype_id'];
		}
		return $ret;
	}
	
}