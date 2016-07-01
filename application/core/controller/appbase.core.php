<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/
class AppBase extends Object{
	private static $instance;
	public $view;
	
	
	/* core objects */
	/**
	 * @var LoaderCore
	 */
	public $load;
	/**
	 * @var ConfigCore
	 */
	public $config;
	/**
	 * @var RouterCore
	 */
	public $router;
	/**
	 * @var InputCore
	 */
	public $input;
	/**
	 * @var LangCore
	 */
	public $lang;
	/**
	 * @var SeoLib
	 */
	public $seoLib;
	
	
	var $_langs = array();
	
	var $_name;
	
	function __construct(){
		$this->AppBase();
	}
	function AppBase(){
		parent::__construct();
		self::$instance =& $this;
		
		//$this->load =& WL::load_core('loader');
		
		$this->_init_cores();
		$this->_config_view();
		
	}
	
	/* 初始化核心对象绑定 */
	protected function _init_cores(){
		$classies = array('config','router','input','lang','loader:load');
		foreach($classies as $k=>$v){
			$v = explode(':',$v);
			$attr = count($v)>1?$v[1]:$v[0];
			$this->$attr =& WL::load_core($v[0]);
		}
	}
	
	/* 初始化视图 */
	protected function _config_view(){
		/* 视图对象  */
		$this->view = new ViewCore();
		/* 加载语言项声明 */
		$app_lang = ($this->router->app_dir?$this->router->app_dir.'/':'') . $this->router->app;
		$this->lang->load($app_lang);
		//ddump($app_lang);
		foreach ($this->_langs as $k=>$lng){
			$this->lang->load($lng);
		}
		
		
		/* SEO */
		$this->seoLib->set_site_title($this->lang->get('site_title'));
		$this->seoLib->title('');
		$this->seoLib->meta('','X-UA-Compatible','IE=Edge');
		$this->seoLib->meta('viewport','','width=device-width, initial-scale=1');
		$this->seoLib->meta('','Content-Type','text/html; charset=utf-8');
		$this->seoLib->meta('','Content-Language','zh-CN');
	}
	
	/* 赋值变量 */
	function assign($key,$value=null){
		return $this->view->assign($key,$value);
	}
	
	/* 添加全局的变量  */
	function assign_global(){
		$this->assign(array(
				'base_url'	=>	site_url()
				
				
		));
	}
	
	/* 输出 */
	function display($tpl){
		/* 全局变量 */
		$this->assign_global();
		
		/* 添加SEO信息 */
		$this->assign('SEO',$this->seoLib->html());
		
		/* 载入语言项变量 */
		$langs = $this->lang->get_all();
		$this->assign('lang',$langs);
		/* js语言变量 */ 
		$jlangs = $this->lang->get_jlangs();
		$this->assign('jlang_json',json_encode($jlangs));
		
		return $this->view->display($tpl);
	}
	
	
	/* 默认的404页面 */
	function display_404(){
		die('404 Page!');
	}
	
	/** json格式输出内容 */
	function json_out($result,$data=NULL,$msg='',$other_data=NULL){
	    $ret = array(
	        'result'=> $result?true:false,
	        'data'  => $data,
	        'msg'   => $msg
	    );
	    if($other_data){
	        $ret=array_merge($ret,$other_data);
	    }
	    echo(json_encode($ret));
	}
	
	/** 
	 * json 格式输出成功结果
	 */
	function json_result($data='',$msg=''){
	    $this->json_out(true,$data,$msg);
	}
	/**
	 * json 格式输出失败结果
	 */
	function json_error($msg=''){
	    $this->json_out(false,NULL,$msg);
	}
	
	/* 启动action的方法 */
	function do_action($method='',$params=NULL){
		/* 动作前事件  */
		if($this->onBeforeAction($method,$params) === false) return;
		if($method && $method{0} !== '_' &&  method_exists($this, $method)){
			if(!empty($params)){
				@call_user_func_array(array($this,$method),$params);
			}else{
				@call_user_func_array(array($this,$method),array());
			}
		}else{
			$this->display_404();
		}
		$this->onAfterAction($method,$params);
	}
	/** 
	 * 启动解析文件的方法
	 * 函数返回false，则表示不解析或解析失败将进入 action路由
	 * 		返回null,则表示解析找不到文件，不进入action路由
	 * **/
	function do_file($dir,$file){
		return false;
	}
	
	/** 输出错误消息 */
	function show_error($msg){
		echo($msg);
		exit;
	}
	
	/** ********************** 过程事件  *******************/
	/** 执行动作方法前触发
	 * @return false	阻止动作执行
	 * @return {else}	执行动作
	 *  **/
	public function onBeforeAction($method='',$params=NULL){}
	
	/** 动作方法执行完后触发  */
	public function onAfterAction($method='',$params=NULL){}
	
	/* 导入前端资源 script或link*/
	function import_res($arr,$type='script'){
	    $this->view->import_res($arr,$type);
	}
	
	
	
	/* 静态获取当前控制器实例的方法 */
	static function &get_instance(){
		return self::$instance;
	}
	
	
	
}