<?php
/**
*
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-6-16
*/

class CommentContentModel extends ModelBase{
	var $_name ='comment';
	var $_tablename = 'comment_content';
	var $_id_field = 'id';
	
	
	var $_validation = array(
			'cont_id'  =>  array('cont_id'=>true),
			'content'   =>  array('required'=>true)
	);
	var $_validation_msgs = array(
			'related_id'  =>  array('required'=>'评论无关联内容'),
			'content'   =>  array('required'=>'评论内容不能为空')
	);
	
	/**
	 * @see ModelBase::columns()
	 */
	function columns(){
		$cols = array();
		$cols['related_id'] = array('name' => 'related_id', 'text'=>'','default'=>'');
		
		return $cols;
	}
	
	/**
	 * 根据关联ID获取评论列表
	 * @param int $cont_id
	 * @param int 1 $page
	 * @param int 10 $pageSize
	 * @param string|array $order
	 */
	function getListByContId($cont_id,$page=1,$pageSize=10,$order='in_time DESC'){
		$params=array();
		$params['where'] = array('cont_id'=>$cont_id);
		$params['page'] = $page;
		$params['pagesize'] = $pageSize;
		$params['order_by'] = is_array($order)?implode(' ',$order):$order;
		$list = $this->get_list($params);
		return $list;
	}
	
	function countByContId($cont_id){
		$params=array();
		$params['where'] = array('cont_id'=>$cont_id);
		$count = $this->get_count($params);
		return $count;
	}
	
	/**
	 * 添加评论
	 * @param string $related_id 关联的内容标识ID
	 * @param array $aData
	 * @return integer|WL_Error
	 */
	function addComment($data){
		$valid = $this->valid_data($data);
		if(is_wl_error($valid)){
			return $valid;
		}
		$fields = array(
				'cont_id'	=>	'',
				'related_title'	=>	'',
				'user_id'		=>	'',
				'user_nick'		=>	'',
				'content'		=>	'',
				'in_time'		=>	time(),
				'reply_time'	=>	0
			);
		$aData = array();
		foreach($fields as $f=>$def){
 			$aData[$f] = isset($data[$f])?related_id:$def;
		}
		$id = $this->add($aData);
		return $id;
	}
	
}