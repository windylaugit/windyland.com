<?php
/**
*
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-5-18
*/

class CaptchaApp extends AppBase{
	/**
	 * @var CaptchaLib
	 */
	var $captchaLib;
	
	function index(){
	
	}
	function do_file($dir,$file){
		$path = ltrim($dir . DIRECTORY_SEPARATOR . $file,DIRECTORY_SEPARATOR);
		$this->load->lib('captcha',null,'captchaLib');
		$this->captchaLib->setSize(120,41);
		$this->captchaLib->doimg();
		captcha_code($path,$this->captchaLib->getCode());
	}
	
}