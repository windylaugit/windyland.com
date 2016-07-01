/**
 * 菜单插件
 * @authors AndyLau (i@windyland.com)
 * @date    2016-04-23 14:03:35
 * @version V1.0.1
 */
"use strict";
(function(factory){
	if(typeof define === 'function' && define.amd){
		define(['jquery'],factory);
	}else{
		factory(jQuery);
	}
})(function($){


$.wlMenu = function(c){
	var m ={
		_init:function(){
			m.conf = $.extend({},m._def,c);
			m.$box = $('<div></div>').addClass('wlMenu-box');
			m.items = {};
			$.each(m.conf.items,function(k,v){
				var i = m._createItem(v);
				m.items[i.id] = i;
				m.$box.append(i.$i);
			});
			return m;
		},
		_def:{
			left:0,
			top:0,
			width:160,
			items:[]
		},
		_createItem:function(i){
			$.extend({
				id:'wlMenu-item-' + Math.random().toString().substr(-6),
				text:'Item',
				onclick:null,
				class:'',
				icon:'',
				line:!1
			},i);
			if(i.line){
				i.$i = $('<div></div>').addClass('wlMenu-line');
				return i;
			}
			i.$i =$('<div></div>').addClass('wlMenu-item').text(i.text).click(function(){ m._clickItem(i);});
			return i;
		},
		_clickItem:function(i){
			if(!i || !i.onclick || typeof i.onclick !== 'function') return;
			i.onclick.call(this,i);
		},
		show:function(left,top){
			$(document).one('click',function(){ m.hide();});
			m.$box.appendTo('body').css({
				left:left,top:top
			}).show();
		},
		hide:function(){
			m.$box.hide().detach();
		}
	},
	_m = {};
	$.each(m._init(),function(k,v){
		if(!/^\_/.test(k)) _m[k] = v;
	});
	return _m;
}
});