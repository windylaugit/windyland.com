<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class AdminAppBase extends AppBase{
	var $_name = 'adminBase';
	/**
	 * @var AdministatorLib
	 */
	var $admin = NULL;
	var $admin_info=NULL;
	// 无需登录的绿色通道
	var $login_green_action = array();
	function __construct(){
		$this->AdminAppBase();
	}
	function AdminAppBase(){
		parent::__construct();
		$this->load->lib('administator',NULL,'admin');
	
	}
	
	/** 配置视图 */
	function _config_view(){
		$this->_langs = array_merge(array('admin/common'),$this->_langs);
		parent::_config_view();
		$this->view->addTemplateDir(APP_PATH . '/templates/admin/_public/');
		$this->seoLib->title($this->lang->get('admin_title'));
	}
	/**
	 * 设置页面路径
	 */
	function set_nav(){
		$navs = array_merge(array('首页'),func_get_args());
		$c = count($navs);
		foreach($navs as $k=>$v){
			$navs[$k] = array(
					'text'	=>	$v,
					'href'	=>	'',
					'is_last'	=>	$k >= $c-1	
				);
		}
		$this->assign('admin_navs',$navs);
	}
	
	/* 显示 */
	function display($tpl=''){
		$this->assign('sys_user',$this->admin_info);
		$this->assign('site',site_info());
        parent::display($tpl);
	}

	function onBeforeAction($method='',$params=NULL){
		/* 检查管理员 登录 */
		
		if($this->admin->has_login()){
			$this->admin_info = $this->admin->get_info();
			return true;
		}else if(in_array($method,$this->login_green_action)){
			return true;
		}else{
			redirect('admin/login');
			return false;
		}
	}
}