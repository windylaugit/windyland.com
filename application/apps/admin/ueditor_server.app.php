<?php
/**
* UEDitor后台服务器程序 - 网站后台版
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-5-26
*/
load_baseapp('admin');
class Ueditor_serverApp extends AdminAppBase{
	
	var $_name = 'ueditor_server';
	
	/**
	 * @var UploadedFileModel
	 */
	var $uploadedFileModel;
	
	private $stateMap = array( //上传状态映射表，国际化用户需考虑此处数据的国际化
			"SUCCESS", //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
			"文件大小超出 upload_max_filesize 限制",
			"文件大小超出 MAX_FILE_SIZE 限制",
			"文件未被完整上传",
			"没有文件被上传",
			"上传文件为空",
			"ERROR_TMP_FILE" => "临时文件错误",
			"ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
			"ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
			"ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
			"ERROR_CREATE_DIR" => "目录创建失败",
			"ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
			"ERROR_FILE_MOVE" => "文件保存时出错",
			"ERROR_FILE_NOT_FOUND" => "找不到上传文件",
			"ERROR_WRITE_CONTENT" => "写入文件内容错误",
			"ERROR_UNKNOWN" => "未知错误",
			"ERROR_DEAD_LINK" => "链接不可用",
			"ERROR_HTTP_LINK" => "链接不是http链接",
			"ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确"
	);
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$act = $this->input->get('action',true);
		if(method_exists($this, $act)){
			call_user_func(array($this,$act));
		}else{
			$this->output(array(
					'state'=> '请求地址出错'
				));
		}
	}
	
	
	/** 配置 **/
	function config(){
		$this->config->load($this->_name,$this->_name);
		$config = $this->config->get(null,$this->_name);
		$this->output($config);
	}
	
	/** 上传图片 **/
	function uploadImage(){
		$this->load->m('system/uploadedFile',null,'uploadedFileModel');
		$info = $this->uploadedFileModel->upload('upfile',array(
					'allowTypes'	=>	array("png", "jpg", "jpeg", "gif", "bmp"),
					'maxSize'		=>	2 * 1024 * 1024
				));
		if(is_wl_error($info)){
			$this->output(array('state'=>$info->message()));
		}else{
			$this->output(array(
						"state" => "SUCCESS",          //上传状态，上传成功时必须返回"SUCCESS"
						"url" => site_url($info['file_url']),            //返回的地址
						"title" => $info['file_name'],          //新文件名
						"original" =>$info['file_id'],//用来传递文件ID . '|' .$info['original_name'],       //原始文件名
						"type" => $info['file_ext'],	         //文件类型
						"size" => $info['file_size'],         //文件大小	
						"file_id"	=>	$info['file_id']
			));
		}
	}
	
	
	private function output($data=array()){
		$json = json_encode($data);
		$cb = $this->input->get('callback',true);
		if($cb){
			if(!preg_match("/^[\w_]+$/", $cb)){
				echo json_encode(array(
						'state'=> 'callback参数不合法'
				));
				exit;
			}
			echo htmlspecialchars($cb) . '(' . $json . ')';
		}else{
			echo $json;	
		}
	}
	
	
	
}