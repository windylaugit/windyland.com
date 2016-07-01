<?php
/**
* 后台用户登录以及权限等相关模块
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-2
*/

class AdministatorLib extends Object{
	/**
	 * @var SysuserModel
	 */
	var $mod = NULL;
	var $sess = NULL;
	var $_has_login = FALSE;
	var $_admin_info = NULL;
	
	var $_sess_key = 'administator_info';
			
	var $_security_key = '923f9429852946c3bb24a53c236f6cad';//安全码，用于计算密码用的
	    //ddump(md5('wlcms_by_andylau_for_windyland_2015'));
	function __construct($sec_key=''){
		parent::__construct();
		$sec_key && $this->_security_key = $sec_key;
		$this->sess =& cc()->load->lib('session');
		$this->mod =& cc()->load->m('system/sysuser');
		
		$this->_auto_login();
		
	}
	/* 自动检测是否登录，并获取用户信息 */
	function _auto_login(){
		$admin_info = $this->sess->userdata($this->_sess_key);
		$this->_set_login($admin_info);
	}
	/* 设置用户信息  */
	function _set_login($admin_info=NULL){
		if($admin_info){
			$this->_admin_info = $admin_info;
			$this->sess->set_userdata($this->_sess_key,$admin_info);
			$this->_has_login = true;
		}else{
			$this->_admin_info = NULL;
			$this->sess->unset_userdata($this->_sess_key);
			$this->_has_login = false;
		}
	}
	
	/* 是否登录 */
	function has_login(){
		return $this->_has_login;
	}
	/* 用户信息 */
	public function get_info($key=''){
		if(!$key){
			return $this->_admin_info;
		}else{
			return isset($this->_admin_info[$key])?$this->_admin_info[$key]:'';
		}
	}
	
	/* 登录操作 */
	public function login($username,$password){
		$spass = $this->_encrypt_password($username, $password);
		$info = $this->mod->get_user($username,$spass);
		if($info){
			$this->_set_login($info);
			return $info['u_id'];	
		}else{
			return false;
		}
	}
	
	/* 登出 */
	function logout(){
		$this->_set_login(NULL);
	}
	
	/* 加密密码  */
	public function _encrypt_password($username,$password){
		//计算username,获得一个2-7的数值
		$ct = (abs(crc32($username)) % 6 ) +2 ;
		while($ct>0){
			$password = md5($password.$this->_security_key);
			$ct --;
		}
		return $password;
	} 
	
}