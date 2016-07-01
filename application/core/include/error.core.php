<?php
/**
* 错误对象类
* 仿写的wordpress系统的WP_Error类
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-12
*/

class WL_Error{
	/**
	 * Stores the list of errors.
	 *
	 * @since 2.1.0
	 * @var array
	 */
	public $errors = array();
	
	/**
	 * Stores the list of data for error codes.
	 *
	 * @since 2.1.0
	 * @var array
	*/
	public $error_data = array();
	
	/**
	 * Initialize the error.
	 *
	 * If `$code` is empty, the other parameters will be ignored.
	 * When `$code` is not empty, `$message` will be used even if
	 * it is empty. The `$data` parameter will be used only if it
	 * is not empty.
	 *
	 * Though the class is constructed with a single error code and
	 * message, multiple codes can be added using the `add()` method.
	 *
	 * @since 2.1.0
	 *
	 * @param string|int $code Error code
	 * @param string $message Error message
	 * @param mixed $data Optional. Error data.
	*/
	public function __construct( $code = '', $message = '', $data = '' ) {
		if ( empty($code) )
			return;
	
		$this->errors[$code][] = $message;
	
		if ( ! empty($data) )
			$this->error_data[$code] = $data;
	}
	/**
	 * 获取所有错误编码
	 * @return array List of error codes, if available.
	 */
	public function codes() {
		if ( empty($this->errors) )
			return array();
	
		return array_keys($this->errors);
	}
	/**
	 * 获取第一个错误编码
	 * @return string|int Empty string, if no error codes.
	 */
	public function code() {
		$codes = $this->codes();
		if ( empty($codes) )
			return '';
		return $codes[0];
	}
	
	
	/**
	 * 
	 * 返回指定编码的错误消息，或者所有错误消息
	 * @since 2.1.0
	 *
	 * @param string|int $code Optional. Retrieve messages matching code, if exists.
	 * @return array Error strings on success, or empty array on failure (if using code parameter).
	 */
	public function messages($code = '') {
		// Return all messages if no code specified.
		if ( empty($code) ) {
			$all_messages = array();
			foreach ( (array) $this->errors as $code => $messages )
				$all_messages = array_merge($all_messages, $messages);
			return $all_messages;
		}
		if ( isset($this->errors[$code]) )
			return $this->errors[$code];
		else
			return array();
	}
	
	/**
	 * 获取指定编码的消息或者第一条错误消息
	 * @since 2.1.0
	 * @param string|int $code Optional. Error code to retrieve message.
	 * @return string
	 */
	public function message($code = '') {
		if ( empty($code) )
			$code = $this->code();
		$messages = $this->messages($code);
		if ( empty($messages) )
			return '';
		return $messages[0];
	}
	
	/**
	 * 获取指定编码(默认第一个)的错误数据
	 *
	 * @since 2.1.0
	 *
	 * @param string|int $code Optional. Error code.
	 * @return mixed Null, if no errors.
	 */
	public function data($code = '') {
		if ( empty($code) )
			$code = $this->code();
		if ( isset($this->error_data[$code]) )
			return $this->error_data[$code];
		return null;
	}
	
	/**
	 * 给当前错误对象，增加一条错误信息
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string|int $code Error code.
	 * @param string $message Error message.
	 * @param mixed $data Optional. Error data.
	 */
	public function add($code, $message, $data = '') {
		$this->errors[$code][] = $message;
		if ( ! empty($data) )
			$this->error_data[$code] = $data;
		
		return $this;
	}
	
	/**
	 * 设置指定编码(默认第一条)错误的错误数据
	 *
	 * @since 2.1.0
	 *
	 * @param mixed $data Error data.
	 * @param string|int $code Error code.
	 */
	public function add_data($data, $code = '') {
		if ( empty($code) )
			$code = $this->code();
	
		$this->error_data[$code] = $data;
	}
	
	/**
	 * 清空当前错误对象的所有错误消息数据
	 *
	 * This function removes all error messages associated with the specified
	 * error code, along with any error data for that code.
	 *
	 * @since 4.1.0
	 *
	 * @param string|int $code Error code.
	 */
	public function remove( $code ) {
		unset( $this->errors[ $code ] );
		unset( $this->error_data[ $code ] );
	}	
}
/**
 * 创建一个新的错误对象
 * @param string|number $code 错误代码
 * @param string $message 错误消息
 * @param mixed $data 错误数据
 */
function wl_error($code, $message, $data = ''){
	return new WL_Error($code,$message,$data);
}
/**
 * 检查是否是一个错误对象
 * @param mixed $thing
 * @return boolean
 */
function is_wl_error( $thing ) {
	return ( $thing instanceof WL_Error );
}

