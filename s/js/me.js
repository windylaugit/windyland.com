/**
 * 核心前端控制器
 */
define(function(require,exports,module){
	require('jquery');
	var me ={
			extend:function(obj){
				me = $.extend(true,me,obj);
				return me;
			},
			C:function(a){ return me.extend(a);},
			link:function(uri){
				if(!me.base_url){
					me.base_url = $('base#base_url').attr('href') || $('base#base_url').attr('data-href') || window.base_url || '/';
					me.base_url = me.base_url.replace(/\/+$/,'') + '/'
				}
				return me.base_url + (uri||'');
			},
			redirect:function(uri){
				uri = uri||'';
				window.location.href = me.link(uri);
			},
			/** 上级控制器 **/
			parent:function(){
				return window.parent?(window.parent.window.WL_Controller||null):null;
			},
			controller:function(ctx){
				return (ctx||window).WL_Controller;
			}
	}
	window.WL_Controller = module.exports = me;
	return me;
});