<?php
/**
* 前台控制器基类
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

class FrontAppBase extends AppBase{
	var $_name = 'frontBase';
	
	var $ctypes = array();
	
	function __construct(){
		parent::__construct();
		
		/* 内容模型 */
		$ctype_mod =& $this->load->m('content/contentsType');
		foreach($ctype_mod->getList() as $k=>$v){
			$this->ctypes[$v['ctype_id']] = $v;
		}
		
	}
	function index(){
		
	}
	/** 配置视图 */
	function _config_view(){
		parent::_config_view();
		$this->view->addTemplateDir(APP_PATH . '/templates/_public/');
		$this->seoLib->title('');
	}
	
	
	/* 显示 */
	function display($tpl=''){
		$this->assign(array(
					'site'	=>	$this->_getConfigSite(),
					'navs'	=>	$this->_getConfigNavs()
				));
        parent::display($tpl);
	}
	/**
	 * 返回站点数据，返回值将输出至前端变量：$site,
	 * 可通过复写该方法，来改变输出值
	 */
	function _getConfigSite(){
		$ret = site_info();
		$ret['base_url'] = site_url();
		return $ret;
	}
	
	/**
	 * 返回导航数据，返回值将输出至前端变量：$navs,
	 * 可通过复写该方法，来改变输出值
	 */
	function _getConfigNavs($curr='index'){
		//TODO 导航数据后续要做到后台管理中
		$ret = array(
				'index'	=>	array('text'=>'首页','href'=>'/'),
				'news'	=>	array('text'=>'互联资讯','href'=>'/news'),
				'tech'	=>	array('text'=>'前沿技术','href'=>'/tech'),
				'apps'	=>	array('text'=>'应用中心','href'=>'/apps'),
				'download'	=>	array('text'=>'下载中心','href'=>'/download')
			);
		if(isset($ret[$curr])){
			$ret[$curr]['active'] = true;
		}else{
			$ret['index']['active'] = true;
		}
		return $ret;
	}
	
	/**
	 * 设置页面面包屑导航路径
	 */
	function _setBreadCrumbs($paths=null){
		$paths = array_merge(array('首页'=>site_url()),$paths?$paths:array());
		$ret = array();
		foreach($paths as $k=>$v){
			$ret[] = array(
					'text'	=>	$k,
					'href'	=>	$v	
				);
		}
		$ret[count($ret)-1]['isLast'] = !0;
		$this->assign('breadCrumbs',$ret);
		return $ret;
	}
}