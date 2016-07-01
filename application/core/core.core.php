<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class WL {
	static $_cores = array();
	static $_CC;
	/* 预加载 */
	static private function _load(){		
		/* 加载基本类 */
		$classies = array('error','result','constants','functions','object','config','router','input','lang');
		foreach($classies as $k=>$name){
			self::load_core($name);
		}		
		/* 加载控制器、模型、视图的基本类 */
		require_once (CORE_PATH . '/controller/appbase.core.php');
		require_once (CORE_PATH . '/model/modelbase.core.php');
		require_once (CORE_PATH . '/view/viewbase.core.php');
	}
	
	/* 加载核心文件 */
	static public function &load_core($name=''){
		if($name){
			if(!isset(self::$_cores[$name])){
				if(is_file(CORE_PATH . "/$name.core.php")){
					require_once (CORE_PATH . "/$name.core.php");
					self::$_cores[$name] = true;
				}else if(is_file(CORE_PATH . "/include/$name.core.php")){
					require_once (CORE_PATH . "/include/$name.core.php");
					self::$_cores[$name] = true;
				}
				if(class_exists(ucfirst($name).'Core') ){
					$class_name = ucfirst($name).'Core';
					self::$_cores[$name]  =new $class_name();
				}	
			}
			return self::$_cores[$name];
		}
		$ret = false;
		return $ret;
	}
	
	/* 核心启动程序 */
	static function START($config){
		self::_load();
		/* 开始路由 */
		$RT = new RouterCore();
		self::$_CC =& $RT->GetApp();
		/* 启动方法 */
		$RT->DoAction();
		
	}

	
	
	
	
}