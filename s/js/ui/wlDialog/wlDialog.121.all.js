/**
 * 弹出框插件，bootstrap样式
 * 重构了代码，引入Deferred、Promise，支持require和工厂模式
 * @authors AndyLau (i@windyland.com)
 * @date    2016-04-25 14:50:11
 * @version V1.2.1
 * @depend	jQuery:^1.7.1
 */

(function(factory){
	if(typeof define === 'function' && define.amd){
		define(['jquery'],factory);
	}else{
		factory(jQuery);
	}
})(function($){
	"use strict";
	var m = function(c){
		return m.open(c);
	}
	$.extend(m,{
		_def:{
			title:'wlDialog',
			content:'',
			url:'',
			width:280,
			height:150,
			class:'',
			left:null,
			top:null,
			buttons:[],
			hideHeader:false,
			hideFooter:false
		},
		_conf:{
			headerHeight:30,
			footerHeight:40	
		},
		_fetch_conf:function(c){
			c = $.extend({},m._def,c);
			if(c.buttons.length == 0) c.hideFooter = true;
			if($.isNumeric(c.height)){
				c._bodyHeight = c.height - (c.hideHeader?0:m._conf.headerHeight) - (c.hideFooter?0:m._conf.footerHeight);	
			}else{
				c._bodyHeight = c.height = 'auto';
			}
			return c;
		},
		_createEles:function(c){
			var eles = {
					$mask:$('<div class="wlDialog-mask"></div>'),
					$dialog:$('<div class="wlDialog"></div>').height(c.height).addClass(c.class),
					$header:$('<div class="wlDialog-header"></div>').height(m._conf.headerHeight).toggle(!c.hideHeader),
					$title:$('<div class="wlDialog-title"><h4></h4></div>'),
					$close:$('<div class="wlDialog-header-close">×</div>'),
					$body:$('<div class="wlDialog-body"></div>').width(c.width).height(c._bodyHeight),
					$footer:$('<div class="wlDialog-footer"></div>').height(m._conf.footerHeight).toggle(!c.hideFooter),
				};
			eles.$dialog.append(
				eles.$header,eles.$body,eles.$footer
			);
			eles.$header.append(eles.$title,eles.$close);
			return eles;
		},
		//Simulator the $.Deferred in simple way
		_promise:function(o){
			var evts = {};
			o = $.extend(o||{},{
				trigger:function(evt,data){
					if(evts[evt]){
						$.each(evts[evt],function(i,cb){
							cb.call(o,data);
						});
					}
					return o;
				},
				on:function(evt,cb){
					if(!evts[evt]) evts[evt] = [];
					evts[evt].push(cb);
					return o;
				},
				extend:function(eo){
					if(eo){
						$.extend(o,eo);
					}
					return o;
				}
			});
			o.events = evts;
			return o;
		},
		_create:function(c){
			c = m._fetch_conf(c);
			var eles = m._createEles(c),
				wld = m._promise({
					visiable:!1,
					isIframe:c.url?!0:!1,
					buttons:{},
					show:function(){
						if(wld.trigger('beforeShow') === true) return;
						eles.$mask.appendTo('body').fadeTo(300,0.3);
						eles.$dialog.appendTo('body');
						wld.reOffset();
						eles.$dialog.fadeIn(300);
						wld.visiable = true;
						wld.trigger('afterShow');
						return wld;
					},
					close:function(){
						wld.trigger('close');
						eles.$mask.fadeOut(300,function(){$(this).detach();});
						eles.$dialog.fadeOut(300,function(){$(this).detach();});
						wld.visiable = false;
						return wld;
					},
					reOffset:function(){
						if(c.height == 'auto') c.height = eles.$body.height();
						eles.$dialog.css({
								left:c.left===null?($(window).width() - c.width)/2:c.left,
								top:(c.top===null?Math.max(0,($(window).height() - c.height)/2):c.top) + $(window).scrollTop()
							});
						return wld;
					},
					get:function(k){
						if(wld.isIframe){
							return eles.$body.find(k);
						}else{
							var $ifa = eles.$body.find('iframe');
							return $ifa.size()?($ifa.get(0).contentWindow[k]||''):null;
						}
					},
					setTitle:function(title){
						eles.$title.find('h4').html(title);	
						return wld;
					},
					setContent:function(cont){
						eles.$body.html(cont);
						return wld;
					},
					setButton:function(id,b){
						if(id && b && wld.buttons[id]){
							var btn = wld.buttons[id];
							if(b.text){
								btn.text = b.text;
								btn.$btn.html(b.text);
							}
							if(b.click) btn.click = b.click;
							if(b.class){
								btn.class = b.class;
								btn.$btn.removeClass().addClass(b.class);
							}
						}
						return wld;
					},
					appendButton:function(b){
						b = m.createButton(b);
						b.$btn.click(function(){
									wld.trigger('buttonClick',b);
									wld.trigger('buttonClick.'+b.id);
							}).appendTo(eles.$footer);
						wld.buttons[b.id] = b;
						return wld;
					},
					//Promise callback
					buttonClick:function(cb,id){
						if(cb){
							wld.on('buttonClick',function(btn){
								if(!id || btn.id === id || $.inArray(btn.id, id.split(',')) >= 0){
									cb.call(wld,btn);	
								}
							});
						}
						return wld;
					}
				})
				//set default buttonClick events for a instance
				.on('buttonClick',function(btn){
						if(btn && btn.click)	btn.click.call(wld,btn);
						return wld;
				});

			//close
			eles.$close.click(function(){
				return wld.close();
			})

			//title
			wld.setTitle(c.title);
			//content
			if(wld.isIframe){
				wld.setContent('<iframe frameboder="0" src="'+c.url+'"></iframe>');	
			}else{
				wld.setContent(c.content);	
			}
			//buttons
			$.each(c.buttons,function(i,b){
				wld.appendButton(b);
			});
			return wld;
		},
		createButton:function(b){
			b = $.extend({
				id:'wlDialog-button-' + Math.random().toString().substr(-6),
				text:'Button',
				class:'default',
				data:{}
			},b||{});
			b.$btn = $('<div class="wlDialog-button"></div>').addClass(b.class).html(b.text);
			return b;
		},
		open:function(c){
			return m._create(c||{}).show();
		},
		//确认框
		confirm:function(content,title,cb){
			var wld = m.open({
				title:title||'确认',
				content:content,
				width:220,
				height:'auto',
				buttons:[
					{text:'确定',id:'yes'},
					{text:'取消',id:'no'}
				]
			})
			.on('buttonClick',function(btn){
				this.close();
				if(cb) cb.call(this,btn.id == 'ok'?!0:!1);
			})
			.extend({
				yes:function(f){
					return wld.on('buttonClick.yes',function(btn){
						f();
					});
				},
				no:function(f){
					return wld.on('buttonClick.no',function(btn){
						f();
					});
				}
			});
			return wld;
		},
		/* 消息提示框 */
		info:function(msg,type,timeout){
			type = type || 'info';
			var $cont = $('<div></div>')
					.append('<div class="wlDialog-icon-'+type+'"></div>')
					.append('<div class="wlDialog-msg">'+msg+'</div>'),
				wld = m.open({
					hideHeader:!0,
					content:$cont,
					width:220,
					height:'auto',
					class:'wlDialog-' + type,
					buttons:timeout?[]:[
						{text:'确定',id:'ok',click:function(){this.close();}}
					]
				})
				.extend({
					ok:function(f){
						return wld.on('buttonClick.ok',function(btn){
							f();
						});
					}
				});
			if(timeout){
				setTimeout(function(){ 
					wld.close();
					wld.trigger('timeout');
				}, timeout);
			}
			return wld;
		},
		/* 成功提示框 */
		success:function(msg,timeout){
			return m.info(msg,'success',timeout);
		},
		/* 警告提示框 */
		warn:function(msg,timeout){
			return m.info(msg,'warn',timeout);
		},
		/* 错误提示框 */
		error:function(msg,timeout){
			return m.info(msg,'error',timeout);
		}
	});
	$.extend({'wlDialog':m});
});


