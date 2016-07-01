<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-07-07
*/

load_baseapp('admin');
class ContentsTypeApp extends AdminAppBase{
	var $_name = 'contentsType';
	var $_langs = array();
	
	function __construct(){
		$this->ContentsTypeApp();
	}
	function ContentsTypeApp(){
		parent::__construct();
		$this->load->m('admin/contentsType',null,'mod');	
	}
	function index(){
				
		$this->display('admin/contents_type/index.html');
	}
	
	function getList(){
		$list = $this->mod->getList();
		
		$this->json_result($list);
	}
	
}