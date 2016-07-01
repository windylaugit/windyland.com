<?php
/**
*
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-14
*/
load_baseapp('admin');
class ConfigApp extends AdminAppBase{
	var $_name = 'config';
	
	
	function __construct(){
		$this->SettingApp();
	}
	function SettingApp(){
		parent::__construct();
		
	}
	
	function index(){
		$this->load->m('system/config',null,'');
		$configs = array();
		foreach($this->configModel->get_configs() as $k=>$v){
			$configs[$k] = $v['c_value'];
		}
		$this->assign('config',$configs);
		$this->set_nav('系统管理','网站设置');
		$this->display('admin/config/index.html');
	}
	
	function base(){
		$this->load->m('system/config',null,'');
		
		//ddump(site('site_url'));
		$conf = $this->configModel->get_configs(array(
				'site_name','site_url','site_title','site_keywords',
				'site_description','site_icp'
			));
		$this->assign('conf',$conf);
		
		$this->display('admin/config/base');
	}
	
	function doSave(){
		$data = $this->input->post('data',true);
		
		$this->load->m('system/config',null,'');
		$res = $this->configModel->set_config($data);
		if($res){
			$this->json_result();
		}else{
			$this->json_error();
		}
	}
	
}