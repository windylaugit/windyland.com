<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class LangCore extends Object{

	var $_charset = 'utf-8';
	var $lang_dir = '';
	var $_loaded = array();
	
	var $_source_data = array();
	var $_clear_data = array();
	var $_jlang_data = array();
	
	
	var $_jlang_pre = '_JLANG_:';//识别为jlang的key前缀
	
	function __construct(){
		$this->LangCore();
	}
	function LangCore(){
		$this->lang_dir = APP_PATH . '/langs';
	}
	
	
	
	/* 加载配置 */
	function load($uris){
		if(!is_array($uris)){
			$uris = array($uris);
		}
		foreach($uris as $k=>$uri){
			if(in_array($uri,$this->_loaded)) continue;
			$file = $this->lang_dir . "/".$this->_charset."/{$uri}.lang.php";
			if(is_file($file)){
				$_lang = require_once($file);
				is_array($_lang) && $this->_source_data = array_merge($this->_source_data,$_lang);
				$this->_parse_data();
			}
		}
	}
	/** 分离解析  */
	function _parse_data(){
		$pre = $this->_jlang_pre;
		$func = function($arr)use(&$func,$pre){
			$cData = array();
			$jData=array();
			foreach($arr as $k=>$v){
				$cd=false;$jd=false;
				if(is_array($v)){
					list($cd,$jd) = $func($v);
					$v = $cd;
				}
				if(strpos($k, $pre)===0){
					$k = substr($k, strlen($pre));
					$jData[$k] = $v;
				}else{
					$j = false;
					!empty($jd) && $jData[$k] = $jd;
				}
				
				$cData[$k]=$v;
				
			}
			return array($cData,$jData);
		};
		
		$ret = $func($this->_source_data);
		$this->_clear_data = $ret[0];
		$this->_jlang_data = $ret[1];
	}
	
	
	/** 获得所有  */
	function get_all($ifclear=true){
	    return $ifclear?$this->_clear_data:$this->_source_data;
	}
	/** 获得所有js语言项  */
	function get_jlangs(){
		return $this->_jlang_data;
	}
	
	
	
	/** 读取 */
	function get($key){
		if(!$key)return NULL;
		$lang = $this->get_all();
		if($lang){
			$lang = $this->_deep_get($lang, $key);
		}
		return $lang;
	}
	
	/** 将变量进行语言化 */
	function trans($array,$fields=array('text'),$level=0){
		$lang = $this->get_all();
		
		$func = function($arr,$fs)use(&$func,$lang){
			foreach($arr as $k=>$v){
				if(is_array($v)){
					$arr[$k]=$func($v,$fs);
				}else{
					if(is_string($v) && in_array($k, $fs)){
						$arr[$k] = $this->_deep_get($lang, $v);
					}
				}
			}
			return $arr;
		};
		
		$ret = $func($array,$fields);
		return $ret;
	}
	
	
	/* 按路径递归取值  */
	function _deep_get($array,$key,$sep='.'){
		if(empty($array)) return NULL;
		$ret = NULL;
		foreach (explode('.',$key) as $i=>$k){
			if(is_array($array)){
				if(isset($array[$k])){
					$ret = $array[$k];
					$array = $array[$k];
				}else{
					$ret=NULL;
					break;
				}
			}else{
				break;
			}
		}
		return $ret;
	}	
}