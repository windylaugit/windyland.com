<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/


require_once(CORE_PATH . '/view/smarty/Smarty.class.php');

class ViewCore extends Smarty{
	var $_all_import_res = array('script','link');
	function __construct(){
		$this->ViewCore();
	}
	function ViewCore(){
		parent::__construct();
		$this->template_dir   = APP_PATH . '/templates';
		$this->compile_dir    = APP_PATH . '/cache/compiled';
		$this->cache_dir      = APP_PATH . '/cache';
		$this->config_dir     = APP_PATH . '/config';
		$this->caching        = false;
		$this->cache_lifetime = 60;
		
		/* 榛樿鏍囩澶勭悊鍣� */
		$this->registerDefaultPluginHandler(array($this,'_defaultPluginHandler'));
	}
	
	
	 /* 榛樿鏍囩鎻掍欢澶勭悊鍣� */
	 function _defaultPluginHandler($name, $type, $template, &$callback, &$script, &$cacheable){
	 	
	 	switch($type){
	 		case Smarty::PLUGIN_FUNCTION:
	 			//$this->_defaultPluginFuncHandler($name, $template, $callback, $script, $cacheable);
	 			return true;
	 			break;
	 		case Smarty::PLUGIN_COMPILER:
	 			
	 			return true;
	 			break;
 			case Smarty::PLUGIN_MODIFIER:
 				
 				
 				return true;
 				break;
	 		default:
	 			return false;
	 			break;
	 	}
	 }
	 
	 function display($tpl='',$a=NULL,$b=NULL,$c=NULL){
	 	if(!preg_match('/\.(html?|tpl)$/',$tpl)) $tpl .= '.html';
		parent::display($tpl,$a,$b,$c);	 	
	 }
	 
	 /* 导入前端资源 script或link*/
	 function import_res($arr,$type='script'){
	     !is_array($arr) && $arr = array($type=>array($arr));
	     foreach($arr as $typ => $srcs){
	         if($typ != 'script' && $typ != 'link') continue;
	         foreach($srcs as $k=>$src){
	             $this->_all_import_res[$typ][$src] = $src;
	         }
	     }
	     //保存到页面
	     $str = '';
	     foreach($this->_all_import_res as $typ=>$srcs){
	         foreach ($srcs as $k=>$src){
	             $src = '/s/' . $src;
	             $str .=  $typ == 'script'?
    	             '<script src="'.$src.'"></script>':
    	             '<link rel="stylesheet" href="'.$src.'" />'."\n";
	         }
	     }
	     $this->assign('all_import_res',$str);
	 }
	 
	 
	 

}
