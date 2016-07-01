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
class DatabaseApp extends AdminAppBase{
	var $_name = 'database';
	var $_langs = array();
	var $login_green_action = array();
	function __construct(){
		$this->DatabaseApp();
	}
	function DatabaseApp(){
		parent::__construct();
		$this->load->m('admin/database',null,'db');	
	}
	/** 数据表列表 */
	function index(){
		
		$columns = $this->lang->trans($this->db->columns(),array('display'));
		
		$this->assign('columns_json',json_encode($columns));
		
		$this->display('admin/database/index.html');
	}

	/** 获得数据表列表 */
	function getList(){
		$list = $this->db->getList();
	
		$this->json_result($list);
	}	
	
	/** 数据库备份还原列表 */
	function rebuild_index(){
		$columns = $this->lang->trans($this->db->bkColumns(),array('display'));
		$this->assign('columns_json',json_encode($columns));
		
		$this->display('admin/database/rebuild.index.html');
	}
	

	/** 获得备份数据列表 */
	function getBackupList(){
		$list = $this->db->getBackUpList();
		$this->json_result($list);
	}
	
	function doBackup(){
		$ifall = intval($this->input->post('ifall'))?true:false;
		$tables = $this->input->post('tables');
		$ret = $this->db->doBackup($ifall?false:$tables);
		if($ret){
			$this->json_result(null,'success!');
		}else{
			$this->json_error('failture!');
		}
	}
	
	
}