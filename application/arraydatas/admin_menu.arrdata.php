<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-29
*/
class Admin_menuArrdata extends ArrdataBase{
	var $_name = 'admin_menu';
	
	
	
	/** 获得菜单  */
	function get($name=''){
		$ret = parent::get($name);
		return $ret;
	}
	
	
}