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
class ColumnApp extends AdminAppBase{
	var $_name = 'column';
	var $_langs = array();
	/**
 	 * @var ColumnModel
	 */
	var $colMod;
	
	function __construct(){
		$this->ColumnApp();
	}
	function ColumnApp(){
		parent::__construct();
		$this->load->m('column/column',null,'colMod');	
	}
	function index(){
				
		$vd =& $this->load->lib('validation');
		
		$this->set_nav('栏目管理','栏目列表');
		$this->display('admin/column/index.html');
	}
	
	function getList(){
		$list = $this->colMod->getOrderedList();
		
		$this->json_result($list);
	}
	
	/** 增加栏目表单页 */
	function add(){
		$options = $this->_getColumnOptions(0,0);
		$this->assign('colOptions',$options);
		
		$this->set_nav('栏目管理','栏目列表','新增栏目');
		$this->display('admin/column/add');
	}
	/** 执行新增栏目  */
	function doAdd(){
		$aData = $this->_getPostData();
		
		$res = $this->colMod->add($aData);
		if($res){
			$this->json_result($res);
		}else{
			$this->json_error('add_failed');
		}
		
	}
	/** 增加栏目表单页 */
	function edit($id){
		$col = $this->colMod->getColumn($id);
		if(empty($col)){
			$this->show_error('No such column!');
		}
		$this->assign('col',$col);
		$options = $this->_getColumnOptions(0,$col['parent_id']);
		
		$this->assign('colOptions',$options);
	
		$this->display('admin/column/add.html');
	}
	/** 执行编辑栏目  */
	function doEdit($id){
		$col = $id?$this->colMod->getColumn($id):false;
		if(!$col){
			$this->json_error('No such column');
			exit;
		}
		
		$eData = $this->_getPostData();
	
		$res = $this->colMod->edit($eData,array(
					'c_id'	=>	$id
				));;
		if($res){
			$this->json_result($res);
		}else{
			$this->json_error('Edit failed');
		}
	
	}
	/** 执行删除栏目  **/
	function doDel($id){
		$col = $id?$this->colMod->getColumn($id):false;
		if(!$col){
			$this->json_error('No such column');
			exit;
		}
		$res = $this->colMod->delete(array('c_id'=>$id));
		if($res){
			$this->json_result($res);
		}else{
			$this->json_error('Delete failed');
		}
		
	}
	
	/** 获得所有栏目的选择树  */
	private function _getColumnOptions($pid=0,$currId=0){
		
		$list = $this->colMod->getOrderedList($pid);
		$opsArr = array(
					'0'	=>	array(
								'text'	=>	L('topLevel'),
								'selected'	=>	$currId == 0?'selected="selected"':''
							)
				);
		foreach($list as $k=>$v){
			$opsArr[$v['c_id']] = array(
						'text'	=>	str_repeat('&emsp;&emsp;', $v['level']+1) . $v['c_name'],
						'selected'	=>	$v['c_id'] == $currId ? 'selected="selected"':''
					);
		}
		
		return $opsArr;
	}
	/* 获取并标准化提交的数据  */
	function _getPostData(){
		$c_name = $this->input->post('c_name');
		$alias = $this->input->post('alias');
		$parent_id = intval($this->input->post('parent_id'));
		$sort_order = intval($this->input->post('sort_order'));
		
		if(!$c_name){
			$this->json_error('Column name required');
			exit;
		}
		$c_name = mb_substr($c_name, 0,6);
		if(!$alias){
			$this->json_error('Column alias required');
			exit;
		}
		$alias = substr($alias,0,10);
		!$parent_id && $parent_id = 0;
		!$sort_order && $sort_order = 255;
		if($sort_order > 255 || $sort_order < 1){
			$this->json_error('Sort order should between 1 to 255');
			exit;
		}
		return array(
					'c_name'	=>	$c_name,
					'alias'		=>	$alias,
					'parent_id'	=>	$parent_id,
					'sort_order'=>	$sort_order
				);
	}
	
}