<?php
/**
*
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-11
*/

$config = array(
		//配置项， ：  [关键字]   或者   [关键字：分组关键字]
		'configs'	=>	array('base','db:db'),
		//语言项	
		'langs'		=>	array('common'),
		//类库
		'libs'		=>	array('seo','session','cache_server:cache'),
		//辅助函数库
		'helpers'	=>	array('common'),
		
	);
return $config;