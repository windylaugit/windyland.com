/**
 * requirejs配置文件
 */
requirejs.config({
	baseUrl:'/s/',
	paths:{
		'jquery':'libs/jquery/jquery.191.min',
		'bts':'libs/bootstrap',
		'admin':'js/admin',
		'ui':'js/ui',
		'pg':'js/page',
		'ueditor': 'libs/ueditor/all',
		'ueditor.min': 'libs/ueditor/ueditor.all.min'
	},
	map:{
			'*': {
				'css': 'libs/require/css'
			}
	},
	shim:{
    	'ueditor':['libs/ueditor/config','libs/ueditor/third-party/zeroclipboard/ZeroClipboard'],
    	'ueditor.min':['libs/ueditor/ueditor.config','libs/ueditor/third-party/zeroclipboard/ZeroClipboard']
	}
});

define('$',function(){return window.$;});