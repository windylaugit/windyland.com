<?php
/**
* 前端内容控制器
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-6-6
*/
load_baseapp('front');
class ContentApp extends FrontAppBase{
	
	/**
	 * @var ColumnModel
	 */
	var $colMod;
	/**
	 * @var ContentArticleModel
	 */
	var $artMod;
	
	public function __construct(){
		parent::__construct();
	
	}
	function index(){
		ddump(time());
		ddump(make_pager(array(
			'baseUrl'	=>	site_url('content/?a=b'),
			'page'	=>	5,
			'total'	=>	9
		)));
		
	}
	
	/** 内容列表页 **/
	function clist($c_id){
		if(!$c_id){
			//@todo 无此栏目页面
			echo('No such column');
			exit;
		}
		/* 栏目 */
		$this->load->m('column/column',null,'colMod');
		$column = $this->colMod->getColumn($c_id);
		if(empty($column) || !isset($this->ctypes[$column['ctype_id']])){
			echo('No such column');
			exit;
		}
		/* 分页 */
		$page = $this->input->get('p',true);
		!$page && $page = 1;
		$pageSize = 20;
		/* 数据 */
		$ctype = $this->ctypes[$column['ctype_id']];
		$list = array();
		if($ctype['ctype_key'] == 'article'){
			$ret = $this->_getArticles($c_id,$page,$pageSize);
			$list = $ret['list'];
			$count = $ret['count'];
		}
		$this->assign('list',$list);
		
		/* 分页 */
		$pager = make_pager(array(
					'baseUrl'	=>	site_url('content/clist/'.$c_id),
					'page'	=>	$page,
					'pages'	=>	ceil($count/$pageSize)	
				));
		$this->assign('pager',$pager);
		
		/* 面包屑导航路径 */
		$breads=array();
		$colAncestors = $this->colMod->getAncestors($column['parent_id']);
		if(!empty($colAncestors)){
			foreach($colAncestors as $k=>$v){
				$breads[$v['c_name']] = site_url('content/clist/'.$v['c_id']);
			}
		}
		$breads[$column['c_name']] = site_url('content/clist/'.$v['c_id']);
		$this->_setBreadCrumbs($breads);
		
		/* 模板 
		 * @todo 后台添加模板机制
		 * */
		$tpl = 'content/article.list.html';
		
		$this->display($tpl);
	}
	/**
	 * 文章内容浏览页
	 */
	function article($aid){
		$this->load->m('content/contentArticle',null,'artMod');
		$article = $this->artMod->getArticle($aid);
		if(empty($article)){
			//@todo 文章不存在
			echo('文章不存在');
			exit;
		}
		$article['content'] = htmlspecialchars_decode($article['content']);
		$this->assign('cont',$article);
		
		/* 面包屑导航路径 */
		$this->load->m('column/column',null,'colMod');
		$breads=array();
		$colAncestors = $this->colMod->getAncestors($article['c_id']);
		if(!empty($colAncestors)){
			foreach($colAncestors as $k=>$v){
				$breads[$v['c_name']] = site_url('content/clist/'.$v['c_id']);
			}
		}
		$breads['文章正文'] = '';
		$this->_setBreadCrumbs($breads);
		
		/* 模板
		 * @todo 后台添加模板机制
		* */
		$tpl = 'content/article.content.html';
		
		$this->display($tpl);
	}
	
	
	private function _getArticles($c_id,$page=1,$pageSize=20){
		$this->load->m('content/contentArticle',null,'artMod');
		$ret = $this->artMod->getArticleList($c_id,$page,$pageSize,array('withThumb'=>true,'countResult'=>true));
		return $ret;
	}
	
	
}