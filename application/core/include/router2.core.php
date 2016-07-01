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
	var $input;
	
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
		$this->input =& WL::load_core('input');
		
		$this->config->load('router','router');
		
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
		if(in_array($this->path_ext, array('js','css','less'))){
			header('HTTP/1.1 404 Not Found');
			exit;
		}else if($this->cc){
			$this->cc->do_action($this->app_method,$this->app_method_parms);
		}else{
			die('page not found!');
		}
	}
	
	/* 解析控制器  */
	private function _fetch_app(){
		/* app目录 */
		$app_dir = empty($this->_paths)?implode('/', $this->_paths) . '/':'';
		
		/* app(控制器)参数 */
		$app = $this->input->get($this->config->get('app_field','router'));
		!$app && $app= 'index';
		
		/* appfile */
		$app_file = CONTROLLERS_PATH . '/' . $app_dir . $app . 'app.php';
		
		/* action(动作方法)参数*/
		$action = $this->input->get($this->config->get('action_field','router'));
		!$action && $action = 'index';
		
		if(is_file($app_file)){
			$this->has_404 = false;
			$this->app = $app;
			$this->app_dir = $app_dir;
			$this->app_file = $app_file;
			$this->app_class = ucfirst($app) . 'App';
			$this->app_method = $action;
			
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
		if(preg_match('/^(.*?)\.(html|htm|php|js|css|ico)$/i', $path,$ms)){
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