<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class LoaderCore extends Object{
	
	protected $_models = array();
	protected $_libs = array();
	
	protected $_loaded_classies=array();
	/**
	 * @var AppBase
	 */
	public $cc;
	function __construct(){
		$this->LoaderCore();
	}
	function LoaderCore(){
		parent::__construct();
		$this->_auto_load();
	}
	
	/* 内部加载对象 */
	protected function &_load_class($name,$parms=NULL,$dir='',$type='model',$attr=NULL){
		if(!isset($this->_loaded_classies[$type])){
			$base_file = APP_PATH . "/{$dir}/{$type}.base.php";
			if(is_file($base_file)){
				include $base_file;
			}
			$this->_loaded_classies[$type] = array();
		}
		
		if(isset($this->_loaded_classies[$type][$name])){
			return $this->_loaded_classies[$type][$name];
		}
		
		$dir && $dir.='/';
		$file = APP_PATH . "/{$dir}{$name}.{$type}.php";
		if(is_file($file)){
			include $file;
		}else{
			$ret = false;
			return $ret;
		}
		
		
		$this->_loaded_classies[$type][$name]=true;
		$names = explode('/',$name);
		$_name = array_pop($names);
		$class_name = ucfirst($_name).ucfirst($type);
		
		
		if(class_exists($class_name)){
			$this->_loaded_classies[$type][$name] = $parms===NULL?new $class_name():new $class_name($parms);
		}
		if($attr !== NULL){
			!$attr && $attr = $_name . ucfirst($type);
			cc()->$attr =& $this->_loaded_classies[$type][$name];
		}
		return $this->_loaded_classies[$type][$name];
	}
	
	/* 加载模型 */
	function &m($name,$parms=NULL,$attr=NULL){
		return $this->_load_class($name,$parms,'models','model',$attr);
	}
	
	/* 加载类 */
	function &lib($name,$parms=NULL,$attr=NULL){
		return $this->_load_class($name,$parms,'libs','lib',$attr);
	}
	/* 加载数据文件对象  */
	function &ad($name,$parms=NULL,$attr=NULL){
		return $this->_load_class($name,$parms,'arraydatas','arrdata',$attr);
	}
	
	/* 加载基本类 */
	
	
	
	/* 初始化加载 */
	function _auto_load(){
		$ci =& cc();
		$ci->config->load('autoload','autoload');
		$autos = $ci->config->get('','autoload');
		
		/** 配置 **/
		if(!empty($autos['configs'])){
			foreach($autos['configs'] as $k=>$v){
				$v = explode(':',$v);
				$ck = count($v)>1?$v[1]:'';
				$ci->config->load($v[0],$ck);
			}
		}
		
		/** 辅助函数 **/
		if(!empty($autos['helpers'])){
			foreach($autos['helpers'] as $k=>$v){
				$f = APP_PATH . '/helpers/'.$v.'.helper.php';
				if(file_exists($f)) 
					include_once $f;
			}
		}
		/** 类库 **/
		if(!empty($autos['libs'])){
			foreach($autos['libs'] as $k=>$v){
				$v = explode(':',$v);
				$ck = count($v)>1?$v[1]:'';
				$this->lib($v[0],NULL,$ck);
			}
		}
		
		/** 语言项  **/
		if(!empty($autos['langs'])){
			foreach($autos['langs'] as $k=>$v){
				$ci->lang->load($v);
			}
		}
		
	}
	
	
}