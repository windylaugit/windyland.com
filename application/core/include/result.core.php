<?php
/**
* 结果对象类
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-19
*/

class WL_Result{
	
	static $_errors=null;
	
	private $_datas=array();
	private $_result;
	private $_error = '';
	
	function __construct($r=null){
		if(isset($r)) $this->result($r);
	}
	
	/**
	 * 返回/设置当前结果是否为真
	 * @param boolean $r [TRUE/FALSE] 
	 * @return boolean
	 */
	function result($r=null){
		if(isset($r)){ $this->_result = $r?!0:!1;}
		return $this->_result;
	}
	/**
	 * 返回/设置当前结果的错误消息
	 * @param string $err 
	 * @return string
	 */
	function error($err=null){
		if(isset($err)){
			$this->_error = $err;
		}
		return $this->_error;
	}
	/**
	 * 清空当前结果绑定的数据
	 * @return WL_Result
	 */
	function clearData(){
		$this->_datas = array();
		return $this;
	}
	/**
	 * 为当前结果对象设置一条数据
	 * @param string|array $key	改数据的key值，若为数组，则将会批量设置
	 * @param mixed $value
	 * @return WL_Result
	 */
	function setData($key,$value=''){
		if(is_array($key)){
			foreach($key as $k=>$v){
				$this->_datas[$k] = $v;
			}
		}else{
			$this->_datas[$key] = $value;
		}
		return $this;
	}
	/**
	 * 返回指定当前结果指定key的数据
	 * @param string $key 不指定该参数，将默认返回第一条添加的数据
	 * @return mixed
	 */
	function getData($key=null){
		if($key===null) return array_values($this->_datas)[0];
		return isset($this->_datas[$key])?$this->_datas[$key]:null;
	}
	/**
	 * 返回当前结果对象上所有的数据。
	 * @return array 结果数据的键值对数组
	 */
	function getDatas(){
		return $this->_datas;
	}	
	
}
/**
 * @return WL_Result
 */
function wl_result($r=null){
	return new WL_Result($r);
}
