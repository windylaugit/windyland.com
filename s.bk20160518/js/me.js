/**
 * 核心前端控制器
 */
define(function(require,exports,module){
	require('jquery');
	var me ={
			init:function(){
				me.base_url = $('base').attr('href').replace(/\/+$/,'') + '/';
				
				return me;
			},
			C:function(obj){
				me = $.extend(true,me,obj);
				return me;
			},
			baseUrl:function(uri){
				if(uri){
					me.base_url = uri;	
				}
				return me.base_url || '/';
			},
			link:function(uri){
				return me.baseUrl() + (uri||'');
			},
			redirect:function(uri){
				uri = uri||'';
				window.location.href = me.link(uri);
			}
			
			
	}
	
	return me.init();
});