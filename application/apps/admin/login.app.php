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
class LoginApp extends AdminAppBase{
	var $_name = 'login';
	
	var $login_green_action = array('index','doLogin');
	
	/**
	 * @var AdministatorLib
	 */
	var $admin;
	
	function __construct(){
		$this->IndexApp();
	}
	function IndexApp(){
		parent::__construct();
		$this->load->lib('administator',null,'admin');
	}
	function index(){
		
		$this->admin->logout();
		$this->display('admin/login.html');
	}
	
	function _config_view(){
	    parent::_config_view();
	    
	}
	
	function doLogin(){
	    $user = $this->input->post('username');
	    $pwd  = $this->input->post('password');
	    if(!$user || !$pwd){
	        $this->json_error('login_need_user_pwd');
	        return;
	    }
	    
	    if($this->admin->has_login()){
	        $this->json_error('login_already_login');
	        return;
	    }
	    $ret = $this->admin->login($user,$pwd);
	    
	    if($ret){
	        $this->json_result(NULL,'login_success');
	    }else{
	        $msg = $this->admin->get_error_msg('login_error');
	        $this->json_error($msg);
	    }
	    
	}
	
	
}