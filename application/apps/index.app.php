<?php
/**
 * 首页控制器
 * @copyright(c) 2015
 * @author AndyLau <i@windyland.com>
 * @package
 * @version V1.0.1
 * @date 2016-05-31
 */


load_baseapp('front');
class IndexApp extends FrontAppBase {
	
	public function __construct(){
		parent::__construct();
		
	}
	function index(){
		
		
		$this->display('front.index');
	}
	
	function _getConfigNavs($curr='index'){
		return parent::_getConfigNavs('index');
	}
	
}
