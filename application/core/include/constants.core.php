<?php
/**
* 全站通用常量定义
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-07-09
*/


class C {
	/* 模型-关联模型类型  */
	const MODEL_RE_TYPE_LEFT = 'LEFT';
	const MODEL_RE_TYPE_RIGHT = 'RIGHT';
	const MODEL_RE_TYPE_INNER = 'INNER';
	const MODEL_RE_TYPE_JOIN = '';
	
	/* 文件附件来源类型 */
	const FILE_SOURCE_LOCAL = 0;
	const FILE_SOURCE_REMOTE = 1;
	
	
	
	
	private static $dys = array();
	
	public static function set($key,$value){
		self::$dys[$key] = $value;
	}
	public static function get($key){
		return isset(self::$dys[$key])?self::$dys[$key]:'';
	}
}