<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/
class ConfigCore extends Object{
	
	var $cfg_dir = '';
	public $_configs = array();
	
	function __construct(){
		$this->ConfigCore();
	}
	function ConfigCore(){
		$this->cfg_dir = APP_PATH . '/config';
		//$this->_auto_load();
	}
	
	
	private function _getc($ck=''){
		!$ck && $ck = '_DEFAULT_';
		!isset($this->_configs[$ck]) && $this->_configs[$ck] = array();
		return $this->_configs[$ck];
	}
	private function _setc($ck='',$cont=''){
		!$ck && $ck = '_DEFAULT_';
		$this->_configs[$ck] = $cont;
	}
	
	/* 加载配置 */
	function load($names,$ckey=''){
		if(!is_array($names)){
			$names = array($names);
		}
		$c = $this->_getc($ckey);
		foreach($names as $k=>$name){
			if(isset($c[$name])) continue;
			$file = $this->cfg_dir . "/{$name}.config.php";
			if(is_file($file)){
				$data = include_once ($file);
				if(is_array($data)) $c = array_merge($c,$data);
			}	
		}
		$this->_setc($ckey,$c);
	}
	
	/* 读取 */
	function get($key,$ckey=''){
		$config = $this->_getc($ckey);
		if(!$key)return $config;
		if(!empty($config)){
			$config = array_deep_get($config, $key);
		}
		return $config;
	}
	
	/* 自动加载 */
	function _auto_load(){
		$loads = array('base'=>'','db'=>'db');
		foreach($loads as $k=>$v){
			$this->load($k,$v);
		}
	}
	
}