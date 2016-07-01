<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/
load_baseapp('admin');
class Content_adminAppBase extends AdminAppBase{
	var $_name = 'content';
	/**
	 * 内容类型名称,需复写
	 * @var string
	 */
	var $_type_name = 'content';
	
	function __construct(){
		$this->Content_adminAppBase();
	}
	function Content_adminAppBase(){
		parent::__construct();
	
	}
	/**
	 * 内容列表页面
	 * @todo	需复写该方法实现功能
	 */
	function index(){}
	/**
	 * ajax 获取列表内容
	 * @todo	需复写该方法实现功能
	 */
	function getList(){}
	/**
	 * 新增页面
	 * @todo	需复写该方法实现功能
	 */
	function add(){}
	/**
	 * 提交新增
	 * @todo	需复写该方法实现功能
	 */
	function doAdd(){}
	/**
	 * 编辑页面
	 * @todo	需复写该方法实现功能
	 */
	function edit(){}
	/**
	 * 提交编辑
	 * @todo	需复写该方法实现功能
	 */
	function doEdit(){}
	/**
	 * 提交删除
	 * @todo	需复写该方法实现功能
	 */
	function doDel(){}
}