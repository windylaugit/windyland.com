<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-8-13
*/
class ValidationLib extends Object{
	
	
	/* 默认的错误信息 */
	private $_msgs = array(
				'required'	=>	'This field is required.',
				'maxlength'	=>	'Please enter no more than {0} characters.',
				'minlength'	=>	'Please enter at least {0} characters.',
				'rangelength'	=>	'Please enter a value between {0} and {1} characters long.',
				'number'	=>	'Please enter a valid number.',
				'digits'	=>	'Please enter only digits.',
				'max'		=>	'Please enter a value less than or equal to {0}.',
				'min'		=>	'Please enter a value greater than or equal to {0}.',
				'range'		=>	'Please enter a value between {0} and {1}.',
				'email'		=>	'Please enter a valid email address.'
			);
	
	private $_current_msgs=array();
	
	function __construct(){
		parent::__construct();
	}
	
	
	private function _msg($rk,$msgs=array(),$args=array()){
		$msg =  isset($msgs[$rk])?$msgs[$rk]:$this->_msgs[$rk];
		if(!$msg) return '';
		if(!empty($args)){
			$msg = preg_replace_callback('/{(\d+)}/m', function($ms)use($args){
				return isset($args[$ms[1]])?$args[$ms[1]]:'';
			}, $msg);
		}
		return $msg;
	}
	
	function valid($data,$rules=array(),$msgs=array(),$checkAll=true){
		$this->_current_msgs = array();
		
		foreach($rules as $name=>$rule){
			if(empty($rule)) continue;
			$val = isset($data[$name])?$data[$name]:NULL;
			$_msg = array();
			foreach ($rule as $rk=>$args){
				!is_array($args) && $args = array($args);
				$method = 'valid_'.$rk;
				if(method_exists($this, $method)){
					array_unshift($args, $val);
					$_valid = call_user_func_array(array($this,$method), $args);
					if(!$_valid){
						array_shift($args);
						$_msg[$rk] = $this->_msg($rk,isset($msgs[$name])?$msgs[$name]:array(),$args);
						if(!$checkAll){
							$this->_current_msgs[$name] = $_msg;
							return false;
						}
					}
				}
			}
			if(!empty($_msg)){
				$this->_current_msgs[$name] = $_msg;
			}
			
		}
		return empty($this->_current_msgs)?true:false;
	}
	
	/** 获得所有错误消息的数组 **/
	function get_valid_arrays(){
		return $this->_current_msgs;
	}
	/** 获取第一个字段的错误数组  **/
	function get_valid_array(){
		$arr = $this->get_valid_arrays();
		return empty($arr)?array():array_shift($arr);
	}
	
	/** 获取第一条错误数据 **/
	function get_valid_msg(){
		$arr = $this->get_valid_array();
		if(empty($arr)) return '';
		return array_shift($arr);
	}
	
	
	/******** 规则验证 ************/
	function valid_required($val){
		return ($val || $val === '0')?true:false;
	}
	
	function valid_maxlength($val,$max=false,$mb=true){
		$val = strval($val);
		if(!$max || $max<=0) return false;
		$len = $mb?mb_strlen($val):strlen($val);
		return $len<= intval($max)?true:false;
	}
	
	function valid_minlength($val,$min=false,$mb=true){
		$val = strval($val);
		if($min===false) return false;
		$len = $mb?mb_strlen($val):strlen($val);
		return $len>= intval($min)?true:false;
	}
	
	function valid_rangelength($val,$min=false,$max=false,$mb=false){
		$val = strval($val);
		if($min===false||$max===false) return false;
		$len = $mb?mb_strlen($val):strlen($val);
		return ($len>=$min && $len<=$max)?true:false;
	}
	
	function valid_number($val){
		return is_numeric($val);
	}
	/** 必须输入整数，虽然翻译单词的结果不是这么理解，但是还是保持了和 jquery validate的一致 **/
	function valid_digits($val){
		return is_int($val);
	}
	
	function valid_max($val,$max){
		return floatval($val) <= $max?true:false;
	}
	
	function valid_min($val,$min){
		return floatval($val) >= $min?true:false;
	}
	
	function valid_range($val,$min=0,$max=1){
		$val = floatval($val);
		$min = floatval($min);
		$max = floatval($max);
		if($min>$max) return false;
		return $val >= $min && $val <= $max ? true:false;
	}
	
	function valid_email($val){
		$regxp = '/^[\w\d][\w\d\-\._]*@[\w\d\-\._]+\.[\w\d]{2,3}$/i';
		return preg_match($regxp, $val)?true:false;
	}
	
	
	
}