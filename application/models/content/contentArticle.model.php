<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-8-29
*/
class ContentArticleModel extends ModelBase{
	var $_name ='content';
	var $_tablename = 'content_article';
	var $_id_field = 'aid';
	var $_relations = array(
			'belong_one_content'	=>	array(
					'table'	=>	'content',
					'alias'	=>	'B',
					'on'	=>	'A.aid = B.mod_id',
					'type'	=>	C::MODEL_RE_TYPE_LEFT
			),
			'belong_one_column'	=>	array(
					'table'	=>	'column',
					'alias'	=>	'C',
					'on'	=>	'A.c_id = C.c_id',
					'type'	=>	C::MODEL_RE_TYPE_LEFT
			),
			'has_thumb_image'	=>	array(
					'table'	=>	'files',
					'alias'	=>	'D',
					'on'	=>	'A.thumb_image = D.file_id',
					'type'	=>	C::MODEL_RE_TYPE_LEFT
			)
	);
	
	var $_validation = array(
			'c_id'  =>  array('required'=>true,'min'=>1),
			'title' =>  array('required'=>true,'maxlength'   =>  20),
			'keywords'  =>  array('required'=>true,'maxlength'   =>  30),
			'author'  =>  array('required'=>true,'maxlength'   =>  10),
			'description'   =>  array('maxlegnth'   =>  200),
	       	'content'   =>  array('required'=>true)
	   );
	var $_validation_msgs = array(
			'c_id'  =>  array('required'=>'请选择栏目','min'=>'请选择栏目'),
			'title' =>  array('required'=>'标题不能为空','maxlength'   =>'标题不能超过20字符'),
			'keywords'  =>  array('required'=>'关键字不能为空','maxlength'   =>'关键字不能超过30字符'),
			'author'  =>  array('required'=>'作者不能为空','maxlength'   =>'作者不能超过10字符'),
			'description'   =>  array('maxlegnth'   =>  '简介不能超过200字符'),
			'content'   =>  array('required'=>'文章内容不能为空')
	   );
	
	/**
	 * 主要内容模型
	 * @var ContentModel
	 */
	var $contentMode;
	
	var $_ctype_id = 1;
	
	function __construct(){
		parent::__construct();
		$this->cc =& cc();
		$this->contentMode =& $this->cc->load->m('content/content');
		
	}	
	
	function getArticle($aid='',$cont_id=''){
		if(!$aid && !$cont_id) return false;
		$where = $aid?array('aid'=>$aid):array('cont_id'=>$cont_id);
		$parms = array(
				'fields'	=>	'A.*,B.cont_id,B.ctype_id,C.c_name,D.file_url as thumb_image_url',
				'join'=>'belong_one_content,belong_one_column,has_thumb_image',
				'order_by'	=>	'A.up_time DESC',
				'where'	=>	$where
		);
		return $this->get_one($parms);
	}
	
	/**
	 * 获得文章列表
	 * @param number $cid 栏目ID
	 */
	function getArticleList($cid=0,$page=1,$pagesize=20,$opts=array()){
		$opts = array_merge(array(
					'withThumb'		=>	false,
					'countResult'	=>	false
				),$opts);
	    $parmas = array(
	    			'fields'	=>	'A.*,B.cont_id,B.ctype_id,C.c_name',
					'page'=>$page,
					'pagesize'=>$pagesize,
					'join'=>'belong_one_content,belong_one_column',
					'order_by'	=>	'A.up_time DESC'
				);
	    if($opts['withThumb']){
	    	$parmas['fields'] .= ',D.file_url AS thumb_image_url';
	    	$parmas['join'] .= ',has_thumb_image';
	    }
		if($cid)$parms['where'] = array('A.c_id'=>$cid);
		$list = $this->get_list($parmas);
		if(!empty($list)){
			foreach($list as $k=>&$v){
				$v['in_time']	=	date('Y-m-d H:i:s',$v['in_time']);
				$v['up_time']	=	date('Y-m-d H:i:s',$v['up_time']);
				$v['url'] = make_url($v,'article');
			}
		}
		if($opts['countResult']){
			$count = empty($list)?0:$this->get_count($parmas);
			return array(
					'list'	=>	$list,
					'count'	=>	$count	
				);
		}else{
			return $list;
		}		
	}
	
	/**
	 * 新增一篇文章
	 * @return WL_Error | integer 错误或者内容ID
	 */
	function addArticle($aData){
		/* 提选数据  */
		$data = array();
		$fields = array('c_id','user_id','title','keywords','author','thumb_image','description','content');
		foreach($fields as $i=>$f){
			$data[$f] = key_exists($f,$aData)?$aData[$f]:null;
		}
		$data['in_time'] = $data['up_time'] = time();
		/* 写入 */
		$aid = $this->add($data);
		$cont_id = $aid?$this->contentMode->add(array(
					'ctype_id'	=>	$this->_ctype_id,
					'mod_id'	=>	$aid
				)):null;
		if($aid && $cont_id){
			return $aid;
		}else{
			return wl_error('add_failed', '新增文章失败');
		}
	}
	/**
	 * 编辑文章
	 * @param integer $aid 文章的ID
	 * @param array $data	编辑的内容数组
	 */
	function editArticle($aid,$eData){
	/* 提选数据  */
		$data = array();
		$fields = array('c_id','user_id','title','keywords','author','thumb_image','description','content');
		foreach($fields as $i=>$f){
			$data[$f] = key_exists($f,$eData)?$eData[$f]:null;
		}
		$data['up_time'] = time();
		/* 写入 */
		$res = $this->edit($data,array('aid'=>$aid));
		if($res){
			return $aid;
		}else{
			return wl_error('edit_failed', '编辑文章失败');
		}
	}
	
	
	
}