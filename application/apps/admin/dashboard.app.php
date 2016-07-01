<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-7
*/

load_baseapp('admin');
class DashboardApp extends AdminAppBase{
	var $_name = 'dashboard';
	
	function __construct(){
		$this->DashboardApp();
	}
	function DashboardApp(){
		parent::__construct();
		
	}
	function index(){
		
		$this->assign('my_info',$this->_get_user_infos());
		
		$this->set_nav('控制台');
		$this->display('admin/dashboard/index');
	}
	
	private function _get_user_infos(){
		$h = intval(date('H'));
		$time_slot = $h < 11?'上午':($h<13?'中午':($h<18?'下午':'晚上'));
		return array(
				'time_slot'	=>	$time_slot,
				'user_name'	=>	$this->admin_info['nick_name']?$this->admin_info['nick_name']:$this->admin_info['user_name']
			);
	}
	
}