<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-15
*/

load_baseapp('content_admin');
class ArticleApp extends Content_adminAppBase{
	/* 内容类型名称 */
	var $_name = 'content/article';
	var $_type_name = 'article';
	var $_ctype_id;
	/** 
	 * @var ContentArticleModel */
	var $contentArticleModel;
	/** 
	 * @var ContentsTypeModel */
	var $contentsTypeModel;
	
	function __construct(){
	    parent::__construct();
	    
	    $this->load->m('content/contentArticle',null,'');
	    $this->load->m('content/contentsType',null,'');
	    
	    $this->_ctype_id = $this->contentsTypeModel->getId($this->_type_name);
	    
	}
	
	
	function index(){
		
		$this->set_nav('内容管理','文章列表');
		$this->display('admin/content/article/index.html');
	}
	
	function getList(){
	    
	    
	    $list = $this->contentArticleModel->getArticleList();
	    $this->json_result($list);
	}
	
	function add(){
		$this->load->m('column/column',null,'');
		$columns = $this->_getColumnOptions(0);
		foreach ($columns as $k=>$col){
			$columns[$k]['c_name'] = str_repeat('&emsp;&emsp;', intval($col['level'])) . $col['c_name'];
		}
		//ddump($columns);
		$this->assign('columns',$columns);
		
		$this->display('admin/content/article/post.html');
	}
	
	function doAdd(){
		$aData = $this->_getPostData();
		$aData['user_id'] = $this->admin->get_info('u_id');
		//ddump($aData);
		$ret = $this->contentArticleModel->addArticle($aData);
		if(is_wl_error($ret)){
			$this->json_error($ret->message());
		}else{
			$this->json_result('','新增成功');	
		}
	}
	
	function edit($aid=''){
		$article = $this->contentArticleModel->getArticle($aid);
		if(empty($article)){
			show_page('common',array('message'=>'该文章不存在'));
			exit;
		}
		$this->assign('article',$article);
		
		$this->assign('columns',$this->_getColumnOptions(0,$article['c_id']));
		
		$this->display('admin/content/article/post.html');
	}
	
	function doEdit($aid=''){
		if(!$aid){
			$this->json_error('该文章不存在');
		}
		$eData = $this->_getPostData();
		$ret = $this->contentArticleModel->editArticle($aid,$eData);
		if(is_wl_error($ret)){
			$this->json_error($ret->message());
		}else{
			$this->json_result('','编辑成功');	
		}
		
		
		
	}
	
	function doDel(){
		
	}
	
	
	function _getPostData($fields=array()){
		$post_data = $this->input->post('post_data');
		$post_data = array_merge(array(
				'c_id'=>null,
				'title'=>'',
				'keywords'	=>	'',
				'author'	=>	'',
				'thumb_image'	=>	'',
				'description'	=>	'',
				'content'	=>	''
			),$post_data?$post_data:array());
		
		
		$post_data['content'] = htmlspecialchars($post_data['content']);
		
		/* 先校验数据  */
		$valid = $this->contentArticleModel->valid_data($post_data,$fields);
		if(is_wl_error($valid)){
			$this->json_error($valid->message());
			exit;
		}
		if(!empty($fields)){
			$ret=array();
			foreach($fields as $i=>$f){
				$ret[$f] = $post_data[$f];
			}
			$post_data = $ret;
		}
	    return $post_data;
	}
	
	/** 获得所有栏目的选择树  */
	private function _getColumnOptions($pid=0,$currId=0){
		$this->load->m('column/column',null,'');
		$list = $this->columnModel->getOrderedList($pid);
		foreach($list as $k=>$v){
			$opsArr[$v['c_id']] = array(
					'text'	=>	str_repeat('&emsp;&emsp;', $v['level']+1) . $v['c_name'],
					'selected'	=>	$v['c_id'] == $currId ? 'selected="selected"':''
			);
		}
		return $opsArr;
	}
	
}