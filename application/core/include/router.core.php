<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class RouterCore extends Object{
	
	var $config;
	var $has_404;
	var $app;
	var $app_file;
	var $app_class;
	var $app_method;
	var $app_method_parms;
	
	var $path_ext = '';
	
	var $cc;
	
	public function __construct(){
		$this->RouterCore();
	}
	public function RouterCore(){
		parent::__construct();
		$this->config =& WL::load_core('config');
		$this->_fetch_paths();
		$this->_fetch_app();
	}
	/* 获得App */
	public function &GetApp(){
		if($this->has_404){
			header('HTTP/1.1 404 Not Found');
			exit;
			return false;
		}else{
			include_once ($this->app_file);
			$class_name = $this->app_class;
			$this->cc = new $class_name();
			return $this->cc;
		}
	}
	
	/* 启动App */
	public function DoAction(){
		if(!$this->cc){
			header('HTTP/1.1 404 Not Found');
			exit;
		}
		$rt = false;
		if($this->path_ext){
			$dir = array($this->app_method);
			$dir = array_merge($dir,$this->app_method_parms);
			$file = array_pop($dir) . '.' . $this->path_ext;
			$dir = implode(DIRECTORY_SEPARATOR,$dir);
			$rt = $this->cc->do_file($dir,$file);
		}
		if($rt === false){
			$this->cc->do_action($this->app_method,$this->app_method_parms);
		}elseif($rt === null){
			header('HTTP/1.1 404 Not Found');
			exit;
		}
		
	}
	
	/* 解析控制器  */
	private function _fetch_app(){
		array_push($this->_paths,'index');//添加一个默认的index
		$app = '';$app_file = '';$method='';$parms=array();
		$len = count($this->_paths);
		$dirs = array();
		for($i=0;$i < $len;$i++){
			$app_file = CONTROLLERS_PATH . '/' . implode('/',array_slice($this->_paths,0,$i+1)) . '.app.php';
			if(is_file($app_file)){
				$app = $this->_paths[$i];
				$i>0 && $dirs =  array_slice($this->_paths,0,$i);
				if($i == $len-1){//app为最后补上的index
					$method = 'index';
					array_push($this->_paths, 'index');
				}elseif($i == $len-2){//app为倒数第二个，method为倒数第一个
					$method = 'index';
				}else{
					array_pop($this->_paths);
					$method = $this->_paths[$i+1];
					$parms = array_slice($this->_paths,$i+2);
				}
				break;
			}
		}
		if($app){
			$this->has_404 = false;
			$this->app = $app;
			$this->app_dir = !empty($dirs)?implode('/',$dirs):'';
			$this->app_file = $app_file;
			$this->app_class = ucfirst($app) . 'App';
			$this->app_method = $method;
			$this->app_method_parms = $parms;
		}else{
			$this->has_404=true;
		}
	}
	
	/* 解析路径字符串 */
	private function _fetch_paths(){
		$path = $this->_detect_uri();
		if(!$path){
			$path = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
		}
		$path = remove_invisible_characters($path,FALSE);
		$path = trim($path,'/');
		if(preg_match('/^(.*?)\.([a-z0-9]+)$/i', $path,$ms)){
			$path = $ms[1];
			$this->path_ext = $ms[2];
		}
		$paths = array();
		if($path){
			$paths = explode('/',$path);
		}
		$this->_paths = $paths;
	}
	
	/* 解析REQUEST_URI ，适应大多数的情况 */
	private function _detect_uri()
	{
		if ( ! isset($_SERVER['REQUEST_URI']) OR ! isset($_SERVER['SCRIPT_NAME']))
		{
			return '';
		}
	
		$uri = $_SERVER['REQUEST_URI'];
		if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
		{
			$uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
		}
		elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
		{
			$uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
		}
	
		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (strncmp($uri, '?/', 2) === 0)
		{
			$uri = substr($uri, 2);
		}
		$parts = preg_split('#\?#i', $uri, 2);
		$uri = $parts[0];
		if (isset($parts[1]))
		{
			$_SERVER['QUERY_STRING'] = $parts[1];
			parse_str($_SERVER['QUERY_STRING'], $_GET);
		}
		else
		{
			$_SERVER['QUERY_STRING'] = '';
			$_GET = array();
		}
	
		if ($uri == '/' || empty($uri))
		{
			return '/';
		}
	
		$uri = parse_url($uri, PHP_URL_PATH);
	
		// Do some final cleaning of the URI and return it
		return str_replace(array('//', '../'), '/', trim($uri, '/'));
	}
	
}