<?php
/**
* 文件/附件 管理
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-5-27
*/
load_baseapp('admin');
class FilesApp extends AdminAppBase{
	var $_name = 'files';
	
	/**
	 * @var FilesModel
	 */
	var $filesModel;
	
	function __construct(){
		parent::__construct();
		
	}
	
	function index(){		
		$this->set_nav('文件管理','文件列表');
		$this->display('admin/files/index.html');
	}
	
	function select(){
		$types = $this->input->get_post('types',true);
		
		$types && $types = explode(',',$types);
		$this->assign('config',array(
					'withoutNav'	=>	!0,
					'fileTypes'	=>	implode(',',$types),
					'multiSelectAble'	=>	!1
				));
		
		$this->display('admin/files/index.html');
	}
	
	function getList(){
		$filter = $this->input->post('filter');
		$page = $this->input->post('page');
		$pageSize = $this->input->post('pageSize');
		$this->load->m('system/files',null,'filesModel');
		$list = $this->filesModel->getFiles($filter,$page,$pageSize);
		if(!empty($list)){
			foreach($list as $k=>&$v){
				$v['add_time_c']	=	date('Y-m-d H:i:s',$v['add_time']);
				$v['file_size_c']   =	$this->bytesToSize($v['file_size']); 
			}
		}
		$this->json_result(array('Rows'=>$list,'Total'=>count($list)));
	}
	
	function doSave(){
		$data = $this->input->post('data',true);
		
		
		if(empty($data)){
			$this->json_error('提交数据为空');
		}
		$file_id = intval($data['file_id']);
		if(!$file_id){
			$this->json_error('文件不存在');
		}
		if(!$data['original_name']){
			$this->json_error('文件名不能为空');
		}
		if(mb_strlen($data['original_name']) > 25){
			$this->json_error('文件名请控制在25个字符以内');
		}
		$eData = array(
					'original_name'	=>	$data['original_name']
				);
		$this->load->m('system/files',null,'filesModel');
		$res = $this->filesModel->edit($eData, array('file_id'=>$file_id));
		if($res !== false){
			$this->json_result();
		}else{
			$this->json_error('文件不存在');
		}
	}
	
	
	private function bytesToSize($bytes) {
		$bytes = intval($bytes); 
    	if ($bytes === 0) return '0 B';  
        $k = 1024;  
        $sizes = array('B','KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');  
        $i = floor(log($bytes) / log($k));
        $ret = round($bytes / pow($k,$i),2) . ' ' . $sizes[$i]; 
	    return $ret;   
	}
	
}