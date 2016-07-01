<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL);

define('ROOT_PATH',dirname(__FILE__)); //全站根目录
define('APP_PATH',ROOT_PATH . '/application');
define('STATIC_PATH',ROOT_PATH . '/s');
define('CORE_PATH',APP_PATH . '/core');
define('CONTROLLERS_PATH',APP_PATH . '/apps');

include (CORE_PATH . '/core.core.php');
/* 启动 */
WL::START(array(




));