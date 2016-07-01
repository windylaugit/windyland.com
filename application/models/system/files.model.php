<?php
/**
* 文件/附件管理 数据模型
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-5-26
*/

class FilesModel extends ModelBase{
	var $_name ='uploadedFile';
	var $_tablename = 'files';
	
	function __construct(){
		parent::__construct();
		
	}
	
	
	/** 
	 * 接收上传文件，并保存
	 * @return array|WL_Error
	 * **/
	function upload($field='upfile',$conf=array()){
		if(!$field){
			return wl_error('no_file', '未找到上传文件');
		}
		$base_conf = cc()->config->get('upload');
		$conf = array_merge($base_conf,$conf);
		$file = $_FILES[$field];
		if(!$file || empty($file)){
			return wl_error('no_file','无上传文件或文件大小超过限制[2M]!');
		}
		if($file['error']){
			$msgs = array(
						0 	=>	'上传成功',
						1	=>	'文件大小超出 upload_max_filesize 限制',
						2	=>	"文件大小超出 MAX_FILE_SIZE 限制",
						3	=>	"文件未被完整上传",
						4	=>	"没有文件被上传",
						5	=>	"上传文件为空"
					);
			return wl_error('file_error_'.$file['error'],$msgs[$file['error']]);
		}
		
		$allowTypes = $conf['allowTypes'];
		$ext = fileext($file['name']);
		if($allowTypes && $allowTypes !== '*'){
			!is_array($allowTypes) && $allowTypes = explode(',',$allowTypes);
			if(!in_array($ext, $allowTypes)){
				return wl_error('type_no_allowed','不允许的文件类型');
			}
		}
		if(!file_exists($file['tmp_name'])){
			return wl_error('no_tmp_file','上传临时文件未找到或已失效');
		}
		$file_name = date('d-His') .rand(100,999) . '.' . $ext;
		$file_url = $conf['path'] . '/' . date('Ym') . '/' . $file_name;
		$file_path = ROOT_PATH . $file_url;
		//创建目录
		wl_mkdir(dirname($file_path));
		if(!move_uploaded_file($file['tmp_name'], $file_path)){
			return wl_error('tmp_move_error','文件保存失败');
		}
		$aData = array(
				'source'	=>	C::FILE_SOURCE_LOCAL,
				'file_url'	=>	$file_url,
				'file_name'	=>	$file_name,
				'original_name'	=>	$file['name'],
				'file_ext'	=>	$ext,
				'file_size'	=>	$file['size'],
				'file_md5'	=>	md5_file($file_path),
				'add_time'	=>	time()	
			);
		$file_id = $this->add($aData);
		if(!$file_id){
			@unlink($file_path);
			return wl_error('save_error','文件保存失败');
		}
		$aData['file_id']	=	$file_id;
		$aData['file_path'] = $file_path;
		return $aData;
	}
	
	
	function getFiles($filter,$order='',$page=1,$pageSize=100){
		$where = array();
		if($filter){
			if(isset($filter['file_ext']) && $filter['file_ext']){
				!is_array($filter['file_ext']) && $filter['file_ext'] = explode(',',$filter['file_ext']);
				$where['file_ext'] = $filter['file_ext'];
			}
		}
		!$page && $page =1;
		!$pageSize && !$pageSize=100;
		!$order && $order = 'in_time DESC';
		
		$list = $this->get_list(array(
					'where'	=>	$where,
					'limit'	=>	array($page,$pageSize),
					'order_ty'	=>	$order
				));
		return $list;
	}
	
	
}