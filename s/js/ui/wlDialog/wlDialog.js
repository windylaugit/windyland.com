/**
* 弹出框插件，bootstrap样式
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-07-15
*/

(function($){
	var me = {
		_def:{
			title:'wlDialog',
			content:'',
			url:'',
			width:280,
			height:150,
			left:null,
			top:null,
			buttons:[]
		},
		_conf:{
			headerHeight:30,
			footerHeight:40	
		},
		_objKey:'wlDialogObject',
		_wlds:[],
		_parseArgs:function(args){
			var ret = {
					Jdoms:[],
					Objects:[],
					Arrays:[],
					Strings:[],
					Numbers:[],
					Functions:[],
					Booleans:[]
				};
			$.each(args,function(i,arg){
				switch ($.type(arg)){
					case 'object':
						if(arg.jquery){
							ret.Jdoms.push(arg);	
						}else{
							ret.Objects.push(arg);
						}
						break;	
					case 'array':
						ret.Arrays.push(arg);
						break;
					case 'string':
						ret.Strings.push(arg);
						break;
					case 'number':
						ret.Numbers.push(arg);
						break;
					case 'function':
						ret.Functions.push(arg);
						break;
					case 'boolean':
						ret.Booleans.push(arg);
						break;
				}
			});
			return ret;
		},
		_create:function(c){
			c = $.extend({},me._def,c);
			
			var wld = {
					eles:{},
					isVisiable:false,
					show:function(){
						wld.eles.$mask.appendTo('body').fadeTo(300,0.3);
						wld.eles.$dialog.appendTo('body');
						if($.isNumeric(c.height)) {
							wld.eles.$body.height(c.height - me._conf.headerHeight - me._conf.footerHeight - 10);//10为body的上下内边距和
							wld.realHeight = c.height;
						}else{
							wld.realHeight = wld.eles.$dialog.height();
						}
						wld.reOffset();
						wld.eles.$dialog.fadeIn(300);
						wld.isVisiable = true;
					},
					close:function(){
						wld.eles.$mask.fadeOut(300,function(){$(this).remove();});
						wld.eles.$dialog.fadeOut(300,function(){$(this).remove();});
						wld.isVisiable = false;
					},
					/* 从iframe子页面中获取对象 */
					get:function(key){
						var $iframe = wld.eles.$body.find('iframe');
						if(!key || !$iframe.size()) return false;
						return $iframe.get(0).contentWindow[key] || null;
					},
					/* 重新定位位置 */
					reOffset:function(){
						wld.eles.$dialog.css({
								left:c.left==null?($(window).width() - c.width)/2:c.left,
								top:(c.top==null?Math.max(0,($(window).height() - wld.realHeight)/2):c.top) + $(window).scrollTop()
							});
					},
					setTitle:function(title){
						wld.eles.$title.find('h4').html(title);	
					},
					setContent:function(cont){
						wld.eles.$body.html(cont);
					}
				}
			
			var eles = wld.eles = {
					$mask:$('<div class="wlDialog-mask"></div>'),
					$dialog:$('<div class="wlDialog"></div>').height(c.height),
					$header:$('<div class="wlDialog-header"></div>').height(me._conf.headerHeight),
					$title:$('<div class="wlDialog-title"><h4></h4></div>'),
					$close:$('<div class="wlDialog-header-close">×</div>').click(wld.close),
					$body:$('<div class="wlDialog-body"></div>').width(c.width),
					$footer:$('<div class="wlDialog-footer"></div>').height(me._conf.footerHeight),
				};
			
			eles.$dialog.append(
				eles.$header,eles.$body,eles.$footer
			);
			eles.$header.append(eles.$title,eles.$close);
			wld.setTitle(c.title);
			
			if(c.url){
				wld.setContent('<iframe frameboder="0" src="'+c.url+'"></iframe>');	
			}else{
				wld.setContent(c.content);	
			}
			if(c.buttons.length){
				$.each(c.buttons,function(i,o){
					if(o.jquery && o.hasClass('wlDialog-button')){
						var $btn = o;
					}else if($.type(o) == 'array'){
						var $btn = me.button.apply(me,o);
					}
					if($btn){
						$btn.data(me._objKey,wld).appendTo(eles.$footer);
					}
				});
			}else{
				wld.eles.$footer.hide();	
			}
			me._wlds.push(wld);
			return wld;
		},
		button:function(){
			var args = me._parseArgs(arguments);
			var bc = {
					text:args.Jdoms[0]||args.Strings[0]||'Button',
					click:args.Functions[0]||$.noop(),
					data:args.Objects[0]||{},
					class:args.Strings[1]||'default'
				};
				//console.log(arguments,args.Jdoms[0],args.Strings[0]);
			var $btn = $('<div class="wlDialog-button"></div>').addClass(bc.class).html(bc.text).click(function(){
						var wld = $(this).data(me._objKey);
						if(wld){
							bc.click(wld,bc.data);	
						}
				});
			return $btn;
		},
		//创建
		open:function(c){
			var wld = me._create(c);
			return wld.show();
		},
		/* 关闭 */
		close:function(wld){
			if(wld && wld.close){
				wld.close();	
			}
		},
		/* 确认对话框 */
		confirm:function(msg,callback,title){
			var d = $.Deferred(),
				r = d.promise({
					yes : function(f){
						return r.done(function(y){
							if(y) f();
						})
					},
					no : function(f){
						return r.done(function(y){
							if(!y) f();
						})
					}
				});
			me.open({
					title:title||'确认',
					content:msg,
					width:200,
					height:'auto',
					buttons:[
						['确定',function(wld){d.resolve(true);wld.close();}],
						['取消',function(wld){d.resolve(false);wld.close();}]
					]
				});
			return r.done(function(y){ if(callback) callback(y);});
		},
		/* 警告框 */
		alert:function(msg,title){
			me.open({
					title:title||'警告',
					content:msg,
					width:200,
					height:'auto',
					buttons:[
						me.button.close('确定')
					]
				});
		},
		/* 成功提示框 */
		success:function(msg,title){
			me.open({
					title:title||'成功',
					content:msg||'操作成功',
					width:200,
					height:'auto',
					buttons:[
						me.button.close('确定')
					]
				});
		}
	};// end of main object	
	// extends button
	$.extend(me.button,{
		close:function(t){
			return me.button(t||'关闭',function(wld){wld.close();});
		}	
		
	});
	/* bind global events */
	$(window).on('resize scroll',function(){
		$.each(me._wlds,function(i,wld){
			if(wld.isVisiable){
				wld.reOffset();	
			}
		});	
	});
	
	//extend to jQuery Object
	$.extend({
		wlDialog:me	
	});
})(jQuery);
