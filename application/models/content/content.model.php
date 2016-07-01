<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-7-9
*/
class ContentModel extends ModelBase{
	var $_name ='content';
	var $_tablename = 'content';
	
	public $_relations = array();
	
	
	var $_validation = array(
	    'c_id'  =>  array('required'=>true,'min'=>1),
	    'title' =>  array('required'=>true,'maxlength'   =>  20),
	    'keywords'  =>  array('required'=>true,'maxlength'   =>  30),
	    'author'  =>  array('required'=>true,'maxlength'   =>  10),
	    'description'   =>  array('maxlegnth'   =>  200)
	);
	var $_validation_msgs = array(
		'c_id'  =>  array('required'=>'请选择栏目','min'=>'请选择栏目'),
	    'title' =>  array('required'=>'标题不能为空','maxlength'   =>'标题不能超过20字符'),
	    'keywords'  =>  array('required'=>'关键字不能为空','maxlength'   =>'关键字不能超过30字符'),
	    'author'  =>  array('required'=>'作者不能为空','maxlength'   =>'作者不能超过10字符'),
	    'description'   =>  array('maxlegnth'   =>  '简介不能超过200字符')
	);
	function columns(){
		$ret = array(
				'cont_id'	=>	array('name' => 'cont_id', 'display' => 'cont_id', 'align' => 'center', 'width' => 40),
				'ctype_id'	=>	array('name' => 'ctype_id', 'display' => 'ID', 'align' => 'center', 'width' => 100,'hidden'=>true),
				'mod_id'	=>	array('name' => 'ctype_id', 'display' => '模型内容ID', 'align' => 'center', 'width' => 100,'hidden'=>true)
			);
		return $ret;
	}
	
	/**
	 * 新增一篇内容，可包含扩展内容,
	 * 增加成功则返回一个包含cont_id和剩余数据的数组
	 * 
	 * @param array $data
	 */
	function addContent($mData){
	    $valid = $this->valid_data($mData);
	    if(is_wl_error($valid)) return $valid->add('valid_failed','字段验证失败');
	    !isset($mData['post_time']) && $mData['post_time'] = time();
	    !isset($mData['modify_time']) && $mData['modify_time'] = $mData['post_time'];
	    $cont_id = $this->add($mData);
	    return $cont_id ? $cont_id : wl_error('add_failed','新增内容失败');
	}
	
	function editContent($cont_id,$eData,$verify=true){
		if(empty($eData)){
			return wl_error('empty_data','编辑数据为空');
		}
		//可编辑字段
		$eFields = array('user_id','title','c_id','sort_order');
		//规则
		$rules = array();
		$data=array();
		foreach($eFields as $i=>$f){
			if(key_exists($f, $eData)){
				isset($this->_validation[$f]) && $rules[$f] = $this->_validation[$f];
				$data[$f] = $eData[$f];
			}
		}
		if(empty($data)){
			return wl_error('empty_data','有效编辑数据为空');
		}
		if($verify){
			$valid = $this->valid_data($data,$rules);
			if(is_wl_error($valid)) {
				return $valid->add('valid_failed','字段验证失败');
			}
		}
		
		//写入编辑数据
		!isset($mData['modify_time']) && $mData['modify_time'] = time();
		
		$res = $this->edit($data, array('cont_id'=>$cont_id));
		
		return $res?!0:wl_error('edit_failed','编辑内容失败');
	}
	
	
	
}