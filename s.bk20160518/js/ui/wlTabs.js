/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-07-06
*/
"use strict";
(function(factory){
	if(typeof define === 'function' && define.amd){
		define(['jquery'],factory);
	}else{
		factory(jQuery);
	}
})(function($){
	
$.fn.extend({
	wlTabs:function(conf){
		var $dom = $(this.get(0));
		
		var me = {
				conf:{
					class:'',
					style:'',
					onClose:function(id){}
				},
				tabs:null,
				tabs_sort:[],
				active_id:'',
				init:function(){
					me.conf = $.extend(me.conf,conf);
					
					me.init_eles();
					return me;
				},
				init_eles:function(){
					me.eles ={
						$div:$('<div class="wlTabs"></div>'),
						$labels:$('<ul class="nav nav-tabs"></ul>'),
						$conts:$('<div class="tab-contents"></div>')	
					}
					if(me.conf.class) me.eles.$div.addClass(me.conf.class);
					if(me.conf.style) me.eles.$div.css(me.conf.style);
					$dom.html(
						me.eles.$div.append(
							me.eles.$labels,
							me.eles.$conts
						)
					);
					if(!me.conf.content_height){
						me.conf.content_height = me.eles.$div.height() - me.eles.$labels.height();
					}
				},
				add:function(c){
					c = $.extend({},{
							id:'',name:'',url:'',content:'',ifclose:true,selected:false
						},c);
					if(!c.id)return false;
					if(!me.tabs){
						me.tabs = {};
						c.selected = true;
						c.ifclose = false;	
					}
					if(!me.tabs[c.id]){
						var obj = me.tabs[c.id] = {
								$label:$('<li></li>').click(function(){me.select(c.id)}),
								$a:$('<a href="javascript:void(0);">'+(c.name||c.id)+'</a>'),
								$cont:$('<div class="tab-pane"></div>').height(me.conf.content_height),
								$close:$('<i class="icon-remove"></i>').click(function(){
									me.close(c.id);	
								})
						}
						obj.$label.append(obj.$a).appendTo(me.eles.$labels);
						if(c.ifclose){obj.$a.append(obj.$close);}
						obj.$cont.appendTo(me.eles.$conts).html(c.url?
							$('<iframe src="'+c.url+'"></iframe>'):
							$(c.content)
						);
						if(c.selected)me.select(c.id);
						me.tabs_sort.push(c.id);
					}
					return me;
				},
				select:function(id){
					if(!id || !me.tabs[id] || id == me.active_id) return false;					
					var act = me.tabs[me.active_id];
					if(act){
						act.$label.removeClass('active');
						act.$cont.hide();	
					}
					var to = me.tabs[id];
					to.$label.addClass('active');
					to.$cont.show();
					me.active_id = id;
					return me;
				},
				close:function(id){
					if(!me.tabs[id] || me.tabs_sort.length<2) return ;
					
					var nxt = 0;
					for(var i = 0;i<me.tabs_sort.length;i++){
						if(me.tabs_sort[i] == id){
							me.tabs_sort.splice(i,1);
							break;
						}
						nxt = i;
					}
					me.select(me.tabs_sort[nxt]);
					me.tabs[id].$label.remove();
					me.tabs[id].$cont.remove();
					delete(me.tabs[id]);
					me.conf.onClose(id);
				},
			};
		
		return $dom.data('wlTabsManager',me.init());
	}
	
});
});