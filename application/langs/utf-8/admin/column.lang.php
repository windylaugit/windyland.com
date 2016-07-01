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
		'add'	=>	'新增栏目',
		
		'fields'	=>	array(
					'c_name'		=>	'栏目名称',
					'alias'			=>	'栏目别名',
					'parent_id'		=>	'父级栏目',
					'sort_order'	=>	'排&emsp;&emsp;序',
					'save'			=>	'保&emsp;存'
				),
		'topLevel'	=>	'顶级栏目',
		'_JLANG_:errors'	=>	array(
					'name_required'		=>	'栏目名称不能为空',
					'alias_required'	=>	'栏目别名不能为空',
					'name_maxlength'	=>	'栏目名称长度不能超过{0}位',
				
					'sort_required'		=>	'排序不能为空',
					'sort_range'		=>	'排序数值不得小于{0}或大于{1}',
					'sort_digits'		=>	'排序数值应为正整数'
				
				
				)
);