<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-29
*/

return array(
			'dashboard'=>array(
					'text'=>'menu.dashboard',
					'href'=>'/admin/dashboard/',
					'icon'=>'Hui-iconfont-home2'
			),
			'columns'	=>	array(
					'text'=>'menu.columns',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-fenlei',
					'subs'=>array(
							'list'=>array(
									'text'=>'menu.column_list',
									'href'=>'/admin/column/',
									'icon'=>''
							)
					)
			),
			'contents'	=>array(
					'text'=>'menu.contents',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-news',
					'subs'=>array(
							'content_types'=>array(
									'text'=>'menu.content_types',
									'href'=>'/admin/contentsType/',
									'icon'=>''
							),
							'art_list'=>array(
									'text'=>'menu.article_list',
									'href'=>'/admin/content/article/',
									'icon'=>''
							),
							'download_list'=>array(
									'text'=>'menu.download_list',
									'href'=>'/admin/content/download/',
									'icon'=>''
							)
					)
			),
			'files'	=>array(
					'text'=>'menu.files',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-file',
					'subs'=>array(
							'image_list'=>array(
									'text'=>'menu.file_list',
									'href'=>'/admin/files/',
									'icon'=>''
							)
					)
			),
			'comments'=>array(
					'text'=>'menu.comments',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-comment',
					'subs'=>array(
							'comment_list'=>array(
									'text'=>'menu.comment_list',
									'href'=>'',
									'icon'=>''
							),
							'feedback'=>array(
									'text'=>'menu.feedback',
									'href'=>'',
									'icon'=>''
							)
					)
			),
			
			'users'=>array(
					'text'=>'menu.users',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-user2',
					'subs'=>array(
							'user_list'=>array(
									'text'=>'menu.user_list',
									'href'=>'',
									'icon'=>''
							)
					)
			),
			'sys_users'=>array(
					'text'=>'menu.sys_users',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-root',
					'subs'=>array(
							'user_list'=>array(
									'text'=>'menu.sys_user_list',
									'href'=>'',
									'icon'=>''
							)
					)
			),
			
			'sys_statistics'=>array(
					'text'=>'menu.sys_statistics',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-shujutongji',
					'subs'=>array(
							
					)
			),
			'system'=>array(
					'text'=>'menu.system',
					'href'=>'javascript:;',
					'icon'=>'Hui-iconfont-system',
					'subs'=>array(
							'config'=>array(
									'text'=>'menu.config',
									'href'=>'/admin/config',
									'icon'=>''
							),
							'sys_logs'=>array(
									'text'=>'menu.sys_logs',
									'href'=>'',
									'icon'=>''
							)
					)
			)
		);