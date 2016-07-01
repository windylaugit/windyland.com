/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlTabs');
	require('ui/wlMenu/wlMenu.all');
	var me = module.exports = require('js/me');
	//var PV = require('PV');
	
	me.C({
		init:function(){
			me.init_eles();
			//me.init_navs();	
			//me.init_tabs();
			me.Pager.init();
			me.Sider.init();
			/* 初始化选择dashboard */
			//me.nav.select('dashboard');
			
			return me;
		},
		/* 初始化主要元素 */
		init_eles:function(){
			me.eles = {
				$header:$('.a-header'),
				$sider:$('.a-sider'),
				$pages:$('.a-pages'),
				$pages_tab:$('.a-pager-tabs'),
				$pages_cont:$('.a-pager-conts'),
				$content:$('.main-content-inner').wlTabs({
						class:'page-tabs',
						style:{height:$(window).height() - $('.main-content-inner').offset().top 
														 - parseInt($('.main-content-inner').css('padding-top'))
														 - parseInt($('.main-content-inner').css('padding-bottom'))},
						onClose:function(id){
							me.Tabs.close(id);	
						}
					})
			}
			$(window).resize(me.resize);
			me.resize();					
		},
		resize:function(){
			var h = $(window).height();
			var hh = me.eles.$header.outerHeight(true);
			var ph = me.eles.$pages_tab.outerHeight(true);
			me.eles.$sider.height(h-hh);
			me.eles.$pages_cont.height(h-hh-ph);
		},
		/* 左侧导航 */
		Sider:{
			navs:{},
			active_id:'',
			active_mid:'',
			init:function(){
				var mn = this;
				mn.eles = {
					$box:$('.a-sider')
				}
				/* 提取列表 */
				mn.eles.$box.find('ul.a-sider-list>li').each(function(){
					var $li = $(this);
					var id = $li.attr('mid');
					var l = mn.navs[id] = {
						id:id,
						mid:id,
						href:$li.find('>a').attr('data-href'),
						$item:$li,
						$label:$li.find('>a').click(function(){ mn.select(id);mn.toggle(id);}),
						parent:false,
						$subs:$li.find('>ul.a-sider-slist')
					}
					if(!l.href || /^javascript/i.test(l.href)) l.href = null;
					if(!l.$subs.size()){
						l.$subs = null;
					}else{
						l.$subs.find('>li').each(function(){
							var $sli = $(this);
							var sid = $sli.attr('sid');
							var sl = mn.navs[sid] = {
								id:sid,
								mid:id,
								href:$sli.find('>a').attr('data-href'),
								$item:$sli,
								$label:$sli.find('>a').click(function(){ mn.select(sid);}),
								parent:l
							}
						});	
					}
					
				});
			},
			select:function(id){
				var mn = this;
				if(!id || !mn.navs[id]) return false;
				var act = mn.navs[mn.active_id];
				var to = mn.navs[id];
				if(act){
					if(to.mid !== act.mid){
						if(act.parent)act.parent.$item.removeClass('active');
						act.$item.removeClass('active');
					}else{
						if(act.parent){
							act.$item.removeClass('active');
						}
					}
				}
				to.$item.addClass('active');
				if(to.parent){
					to.parent.$item.addClass('active');
				}
				mn.active_id = id;
				if(to.href){
					//me.Tabs.switch(to.id,to.$label.text(),to.href);
					me.Pager.open({
							id:to.id,
							text:to.$label.text(),
							href:to.href
						});
				}
				
			},
			/* 切换显示 */
			toggle:function(mid,bol){
				var mn = this;
				if(!mid || !mn.navs[mid] || !mn.navs[mid].$subs) return false;
				bol = bol === true?'Down':(bol===false?'Up':'Toggle');
				mn.navs[mid].$subs['slide'+bol]();
				if(mn.active_mid != mid && mn.navs[mn.active_mid] ){
					mn.navs[mn.active_mid].$subs.slideUp();
				}
				mn.active_mid = mid;
			}
		},
		
		/* 多页面控制 */
		Pager:{
			pages:{},
			pageOrders:[],
			active_id:'',
			init:function(){
				var mp = this;
				mp.$tab = $('<ul class="clearfix"></ul>').appendTo(me.eles.$pages_tab);	
				mp.$cont = me.eles.$pages_cont;

				mp.WlMenu = $.wlMenu({
					items:$.map(mp.menus,function(i){ if(!i.line){ i.onclick= function(i){mp.menuClick(i);};return i;} })
				})
			},
			menus:[
				{id:'refresh',text:'刷新'},
				{line:true},
				{id:'close',text:'关闭'},
				{id:'closeOther',text:'关闭其他'},
				{id:'closeAll',text:'关闭所有'},
			],
			menuClick:function(i){
				var mp = this,
					pa = mp.pages[mp.onMenuId];
				if(!pa) return false;
				switch(i.id){
					case 'refresh':
						mp.refresh(pa.id);
						break;
					case 'close':
						mp.close(pa.id);
						break;
					case 'closeOther':

						break;
					case 'closeAll':

						break;
				}

			},
			showMenu:function(e,id){
				var mp = this,
					pa = mp.pages[id];
				if(!pa) return false;
				mp.onMenuId = id;
				mp.WlMenu.show(e.pageX,e.pageY);
			},
			open:function(c){
				var mp = this;
				if(!c || !c.id || !c.text || !c.href) return false;
				if(!mp.pages[c.id]){
					mp.pages[c.id] = {
						id:c.id,
						text:c.text,
						href:c.href,
						$tab:mp.create_tab(c).appendTo(mp.$tab),
						$cont:mp.create_cont(c).appendTo(mp.$cont)
					}
					mp.pageOrders.push(c.id);
				}
				mp.switch(c.id);
			},
			refresh:function(id){
				var mp = this,
					pa = mp.pages[id];
				if(!pa) return false;
				pa.$cont.find('iframe').attr('src',pa.href);
			},
			close:function(id){
				var mp = this;
				if(!id || !mp.pages[id]) return false;
				mp.pages[id].$tab.remove();
				mp.pages[id].$cont.remove();
				mp.pages[id] = null;
				delete mp.pages[id];
				var nxt = null,orders=[],find=!1;;
				$.each(mp.pageOrders,function(i,o){
					if(o == id){
						 find = !0;
					}else{
						if(nxt === null || !find) nxt = o;
						orders.push(o);
					}
				});
				mp.pageOrders = orders;
				if(mp.active_id == id && (nxt !== null)){
					mp.switch(nxt);	
				}
			},
			switch:function(id){
				var mp = this;
				if(!id || !mp.pages[id]) return false;
				if(mp.active_id === id) return true;
				if(mp.active_id && mp.pages[mp.active_id]){
					var atv = mp.pages[mp.active_id];
					atv.$tab.removeClass('wl-active');
					atv.$cont.removeClass('wl-active');
				}
				mp.pages[id].$tab.addClass('wl-active');
				mp.pages[id].$cont.addClass('wl-active');
				mp.active_id = id;
			},
			create_tab:function(o){
				var mp = this;
				var $a = $('<a href="javascript:;"></a>').text($.trim(o.text)).click(function(){ mp.switch(o.id); });
				if(!o.noclosed) $a.append($('<i class="icon-close"></i>').click(function(){mp.close(o.id);}));
				return $('<li></li>').append($a).on('contextmenu',function(e){ mp.showMenu(e,o.id);return false;});
			},
			create_cont:function(o){
				var $o = $('<div></div>').append($('<iframe frameboder="0" src="'+o.href+'"></iframe>'));
				return $o;
			}
			
			
		},
		
		/* 初始化导航 */
		init_navs:function(){
			var mn = me.nav = {
					navs:{},
					active_id:'',
					active_mid:'',
					select:function(id){
						if(!id || !mn.navs[id] || id==mn.active_id) return false;
						var act = mn.navs[mn.active_id];
						var to = mn.navs[id];
						if(act){
							if(to.mid !== act.mid){
								if(act.parent)act.parent.$item.removeClass('active');
								act.$item.removeClass('active');
							}else{
								if(act.parent){
									act.$item.removeClass('active');
								}
							}
						}
						to.$item.addClass('active');
						if(to.parent){
							to.parent.$item.addClass('active');
						}
						mn.active_id = id;
						if(to.href){
							me.Tabs.switch(to.id,to.$label.text(),to.href);
						}
						
					},
					/* 切换显示 */
					toggle:function(mid,bol){
						if(!mid || !mn.navs[mid] || !mn.navs[mid].$subs) return false;
						bol = bol === true?'Down':(bol===false?'Up':'Toggle');
						mn.navs[mid].$subs['slide'+bol]();
						if(mn.active_mid != mid && mn.navs[mn.active_mid] ){
							mn.navs[mn.active_mid].$subs.slideUp();
						}
						mn.active_mid = mid;
					},
				
				}
			/* 提取列表项 */
			var $lis = me.eles.$sidebar.find('ul.a-sider-list>li').each(function(i,li){
					var $li = $(li);
					var id = $li.attr('mid');
					var $a = $li.find('>a').click(function(){
							me.nav.select(id);
							me.nav.toggle(id);
							return false;
						});
					var href = $a.attr('href');
					if(!href || /^javascript/i.test(href)) href = false;
					
					var $ul = $li.find('>ul.submenu');
					me.nav.navs[id] = {
							id:id,
							mid:id,
							href:href,
							$item:$li,
							$label:$a,
							parent:false,
							$subs:$ul.size()?$ul:null,
						}
					if($ul.size()){
						$ul.find('>li').each(function(k,sli){
							var $sli = $(sli);
							var sid = $sli.attr('sid');
							var $sa = $sli.find('>a').click(function(){
										me.nav.select(sid);
										return false;
									});
							var shref = $sa.attr('href');
							if(!shref || /^javascript/.test(shref)) shref = false;
							var subm = {
									id:sid,
									mid:id,
									href:shref,
									$item:$sli,
									$label:$sa,
									parent:me.nav.navs[id]
								}
							me.nav.navs[sid] = subm;
						});
					}
				
			});
		},
		init_tabs:function(){
			var mt = me.Tabs = {
					m:me.eles.$content.data('wlTabsManager'),
					added:{},
					switch:function(id,text,url){
						if(!mt.added[id]){
							mt.m.add({
									id:id,name:text,url:url,
									selected:true
								});
							mt.added[id] = id;
						}else{
							mt.m.select(id);	
						}
					},
					close:function(id){
						if(mt.added[id]){
							mt.m.close(id);
							delete mt.added[id];	
						}
					}
				}
			
		},
		
		
	});
	
	return me.init();
});