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
class ContentApp extends AdminAppBase{
	var $_name = 'content';
	var $login_green_action = array('index');
	function __construct(){
		$this->ContentApp();
	}
	function ContentApp(){
		parent::__construct();
		
	}
	function index(){
		
		
		
		
		$this->display('admin/content/index.html');
	}
	
}