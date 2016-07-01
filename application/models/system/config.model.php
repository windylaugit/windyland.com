<?php
/**
* 配置数据模型
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-14
*/

class ConfigModel extends ModelBase{
	var $_name ='config';
	var $_tablename = 'config';
	
	var $_data=array();
	
	/**
	 * 获得所有配置
	 * @return array()
	 */
	function get_configs($field=''){
		if(empty($this->_data)){
			$res = $this->get_list();
			if(!empty($res)){
				foreach($res as $k=>$v){
					$this->_data[$v['c_key']] = $v;
				}
			}
		}
		$ret = $this->_data;
		if($field){
			foreach($ret as $k=>$v){
				$ret[$k] = $v[$field];
			}
		}
		return $ret;
	}
	
	/**
	 * 获得单个配置
	 */
	function get_config($c_key){
		$configs = $this->get_configs();
		return isset($configs[$c_key])?$configs[$c_key]:null;
	}
	/**
	 * 获得单个配置的值
	 */
	function get_config_value($c_key){
		return isset($this->_data[$c_key])?$this->_data[$c_key]['c_value']:'';
	}
	function set_config($arr,$value=''){
		if(!is_array($arr)){
			$arr = array($arr=>$value);
		}
		foreach($arr as $k=>$v){
			
			if($this->get_config($k) === null){
				$this->add(array('c_key'=>$k,'c_value'=>$v,'c_desc'=>''));
			}else{
				$this->edit(array('c_value'=>$v), array('c_key'=>$k));
			}
			$this->_data[$k] = $v;
		}
		return true;
	}
}
