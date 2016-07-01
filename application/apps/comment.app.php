<?php
/**
* 前端-评论控制器
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-6-13
*/
load_baseapp('front');
class CommentApp extends FrontAppBase{
	
	
	/**
	 * @var CommentContentModel
	 */
	var $CommentContentModel;
	
	public function __construct(){
		parent::__construct();
		
	}
	function index(){
		
	}
	/**
	 * 获取内容相关的评论内容
	 */
	function getContentComments(){
		$cont_id = $this->input->post('cont_id',true);
		$page = $this->input->post('page'); !$page && $page = 1;
		$pageSize = $this->input->post('pageSize'); !$pageSize && $pageSize = 5;
		
		$this->load->m('comment/commentContent',null,'CommentContentModel');
		$list = $this->CommentContentModel->getListByContId($cont_id);
		if(!empty($list)){
			$total = $this->CommentContentModel->countByContId($cont_id);
		}else{
			$total = 0;
		}
		$this->json_result(array(
				'rows'	=>	$list,
				'total'	=>	$total	
			));		
	}
	
	
	function doAdd(){
		$data = $this->input->post('post_data');
		
		ddump($data);
	}
	
}