<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

return array(
		'site_url'=>'http://windyland.lst',
		
		/* 缓存配置 */
		'cache_server'	=>	array(
					'path'	=>	APP_PATH . '/cache/datas',
					'dir_num'	=>	500 // 子目录数量
				),
		
		/* 上传文件配置 */
		'upload'	=>	array(
					'path'	=>	'/upload',
					'allowFiles'	=>	array(
							        "png", "jpg", "jpeg", "gif", "bmp",
							        "flv", "swf", "mkv", "avi", "rm", "rmvb", "mpeg", "mpg",
							        "ogg", "ogv", "mov", "wmv", "mp4", "webm", "mp3", "wav", "mid",
							        "rar", "zip", "tar", "gz", "7z", "bz2", "cab", "iso",
							        "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "md", "xml"
							    ),
					"maxSize"=> 2048000, /* 上传大小限制，单位B,默认 2 Mb */
				)
		
		
);