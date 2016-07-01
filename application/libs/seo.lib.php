<?php
/**
* 实现页面SEO信息控制的seo工具类，包含title、keywords、meta等
* 
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-24
*/
class SeoLib extends Object{
	protected $_title = '';
	protected $_metas = array();
	protected $_site_title = '';
	
	function __construct(){
		$this->SeoLib();
	}
	function SeoLib(){
		parent::__construct();
		
		/* 默认添加 */
	}
	
	/* 添加meta */
	function meta($name='',$http_equiv='',$content=''){
		if(!$content || (!$name && !$http_equiv)) return $this->_metas;
		$this->_metas[$name?$name:$http_equiv] = compact('name','content','http_equiv');
		return true;
	}
	function set_site_title($site_title=''){
		$this->_site_title = $site_title;
	}
	/* 设置title */
	function title($title='',$site_title=''){
		if(!$title) return $this->_title;
		if(is_array($title)){
			$title = implode('-', $title);
		}
		$site_title === '' && $site_title = $this->_site_title;
		$this->_title = $title . '-' . $site_title;
		return true;
	}
	
	/* 返回 */
	function output(){
		return array(
					'title'	=>	$this->_title,
					'metas'	=>	$this->_metas
				);
	}
	function html(){
		$ret = array('title'=>'<title>'.$this->_title.'</title>','metas'=>'');
		foreach($this->_metas as $k=>$v){
			$ret['metas'] .= '<meta ' . ($v['http_equiv']?'http-equiv="'.$v['http_equiv'].'"':'name="'.$v['name'].'"') . 
								' content="'.$v['content']."\">\n";
		}
		return $ret;
	}
	
	
	/* */
	
}