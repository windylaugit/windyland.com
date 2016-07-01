/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	var $ = require('jquery');
	require('ui/wlTabs');
	require('ui/wlMenu/wlMenu.all');
	var me = module.exports = require('js/me');
	//var PV = require('PV');
	
	me.C({
		init:function(){
			me.init_eles();
			me.Pager.init();
			me.Sider.init();

			//默认打开首页，且不可删除
			me.Pager.open({
				id:'dashboard',
				text:'控制台',
				href:me.link('admin/dashboard'),
				noclosed:true
			});	
			return me;
		},
		/* 初始化主要元素 */
		init_eles:function(){
			me.eles = {
				$header:$('#j_header'),
				$sider:$('#j_aside'),
				$section:$('#j_section'),
				$section_navs:$('#j_section_navs'),
				$section_conts:$('#j_section_conts')
				// $content:$('.main-content-inner').wlTabs({
				// 		class:'page-tabs',
				// 		style:{height:$(window).height() - $('.main-content-inner').offset().top 
				// 										 - parseInt($('.main-content-inner').css('padding-top'))
				// 										 - parseInt($('.main-content-inner').css('padding-bottom'))},
				// 		onClose:function(id){
				// 			me.Tabs.close(id);	
				// 		}
				// 	})
			}
			$(window).resize(me.resize);
			me.resize();					
		},
		resize:function(){
			var h = $(window).height();
			var hh = me.eles.$header.outerHeight(true);
			me.eles.$sider.height(h-hh);
			me.eles.$section.height(h-hh);
		},
		/* 左侧导航 */
		Sider:{
			navs:{},
			active_id:'',
			expanded_mid:'',
			init:function(){
				var mn = this;
				mn.eles = {
					$box:me.eles.$sider
				}
				/* 提取列表 */
				mn.eles.$box.find('dl').each(function(){
					var $dl = $(this);
					var id = $dl.attr('mid');
					var l = mn.navs[id] = {
						id:id,
						mid:id,
						$item:$dl,
						$label:$dl.find('dt').click(function(){ mn.select(id);mn.toggle(id);}),
						href:$dl.find('dt>a').attr('data-href'),
						parent:false,
						$subs:$dl.find('dd'),
						expanded:false
					}
					if(!l.href || /^javascript/i.test(l.href)) l.href = null;
					if(!l.$subs.find('li').size()){
						l.$subs = null;
					}else{
						l.$subs.find('li').each(function(){
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
			//展开
			expand:function(mid){
				var mn = this,
					it = mn.navs[mid];
				if(!it || !it.$subs) return false;
				if(it.expanded) return ;
				it.expanded = true;
				it.$subs.slideDown('fast');
				it.$label.addClass('selected');
				if(mn.expanded_mid != mid && mn.navs[mn.expanded_mid] ){
					//mn.navs[mn.expanded_mid].$subs.slideUp('fast');
					mn.collapse(mn.expanded_mid);
				}
				mn.expanded_mid = mid;
			},
			//折叠
			collapse:function(mid){
				var mn = this,
					it = mn.navs[mid];
				if(!it || !it.$subs) return false;
				if(!it.expanded) return ;
				it.expanded = false;
				it.$subs.slideUp('fast');
				it.$label.removeClass('selected');
			},
			/* 切换显示 */
			toggle:function(mid,bol){
				var mn = this,
					it = mn.navs[mid];
				if(!it) return;
				var bol = bol === true?true:(bol===false?false:(!it.expanded));
				return this[bol?'expand':'collapse'].call(this,mid);
			}
		},
		
		/* 多页面控制 */
		Pager:{
			pages:{},
			pageOrders:[],
			active_id:'',
			init:function(){
				var mp = this;
				mp.$tab = $('<ul class="acrossTab cl"></ul>').appendTo(me.eles.$section_navs);	
				mp.$cont = me.eles.$section_conts;

				mp.WlMenu = $.wlMenu({
					items:$.map(mp.menus,function(i){ if(!i.line){ i.onclick= function(i){mp.menuClick(i);};return i;} })
				});
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
					atv.$tab.removeClass('active');
					atv.$cont.removeClass('active').hide();
				}
				mp.pages[id].$tab.addClass('active');
				mp.pages[id].$cont.addClass('active').show();
				mp.active_id = id;
			},
			create_tab:function(o){
				var mp = this,
					tit = $.trim(o.text),
					$o = $('<span>').text(tit).attr('title',tit).click(function(){ mp.switch(o.id); }),
					$li = $('<li>').append($o).on('contextmenu',function(e){ mp.showMenu(e,o.id);return false;});
				if(!o.noclosed) $li.append($('<i class="Hui-iconfont-close2"></i>').click(function(){mp.close(o.id);}));
				$li.append('<em>')
				return $li;
			},
			create_cont:function(o){
				var $o = $('<div></div>').append($('<iframe scrolling="yes" frameboder="0" src="'+o.href+'"></iframe>'));
				return $o;
			}
			
		},
		/* 链接相关控制 */
		Link:{
			init:function(){
				this.find();
			},
			find:function(context){
				this.bind($('.wl-tab-link,.wl-top-link',context||document));
			},
			bind:function($doms){
				var ml = this;
				$doms.each(function(i,o){
					if($(o).data('link-rendered')) return true;
					$(o).data('link-rendered',true);
					var href = $(o).attr('data-href')||$(o).attr('href');
					if(!href || /^javascript/.test(href)) return true;
					var $o = $(o),
						type = $o.hasClass('wl-tab-link')?'tab':'top',
						id = $o.attr('data-link-id')||'wl-link-'+Math.random(),
						tit = $o.attr('data-link-title')||'WL_CMS';

					if(type == 'tab'){
						$o.click(function(){
							me.Pager.open({
								id:id,
								text:tit,
								href:href
							});
							return false;
						});
					}else if(type == 'top'){
						$o.click(function(){
							ml.top(href);
							return false;	
						});
					}
				});
			},
			top:function(url){
				window.open(url);
			}	
		}
	});
	
	return me.init();
});