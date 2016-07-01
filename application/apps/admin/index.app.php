<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-15
*/

load_baseapp('admin');
class IndexApp extends AdminAppBase{
	var $_name = 'index';
	var $login_green_action = array();
	function __construct(){
		$this->IndexApp();
	}
	function IndexApp(){
		parent::__construct();
		
	}
	function index(){
		
		
		/* 首页菜单 */
		$this->load->ad('admin_menu',null,'menuAd');
		$menu = $this->lang->trans($this->menuAd->get());
		$this->assign('menu',$menu);
		
		$this->display('admin/admin.index.html');
	}
	
}