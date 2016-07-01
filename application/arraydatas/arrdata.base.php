<?php
/**
* 
* 
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-24
*/
class ArrdataBase extends Object{
	public $_name = '';
	public $_datas = array();
	private $_loaded=array();
	function __construct(){
		$this->ArrdataBase();
	}
	function ArrdataBase(){
		parent::__construct();
		$this->load($this->_name);
		
	}
	
	/** 加载数据,可通过复写该方法来替换默认的从文件读取数据的方式  */
	function load($name='',$key=''){
		if(!$name) return false;
		$file = APP_PATH . '/arraydatas/data/'.$name . '.data.php';
		if(is_file($file)){
			!$key && $key = $name;
			$this->_datas[$key] = include($file);
			return $this->_datas[$key];
		}
		return NULL;
	}
	
	/** 获得数据 */
	function get($name='',$data_key=''){
		!$data_key && $data_key  = $this->_name;
		$data = isset($this->_datas[$data_key])?$this->_datas[$data_key]:NULL;
		if(!$name){
			return $data;
		}else{
			return array_deep_get($data, $name,'.');
		}
	}
}