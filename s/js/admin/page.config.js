/**
 * 网站设置
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');
	var me = module.exports = require('js/me');
	
	
	me.extend({
		data:{},
		post_data:{},
		init:function(){
			me.init_eles();
			me.Tabs.init();
			return me;
		},
		init_eles:function(){
			me.eles = {
					$form:$('#j_config_form').submit(function(){ return false;}),
					$tabs:$('#j_config_tabs'),
					$submit:$('#j_config_submit').click(function(){ me.save();})
				}
			me.eles.$form.find('input,select,textarea').each(function(i,o){
				var $o = $(o),
					name = $o.attr('name');
				if(!name) return true;
				me.data[name] = $o.val();
				$o.blur(function(){
					me.changeData(name,$(this).val());
				});
			});
		},
		Tabs:{
			curr_key:null,
			init:function(){
				var mt = this;
				mt.parts = {};
				me.eles.$tabs.find('span[data-cont]').each(function(i,o){
						var $o = $(this),
							key = $o.attr('data-cont');
						mt.parts[key] = {
							key:key,
							$tab:$o.click(function(){ mt.switch(key);}),
							$cont:$('#j_config_cont_'+key)
						}
				});
				mt.switch('base');
			},
			switch:function(key){
				var mt = this,
					pt = mt.parts[key];
				if(!pt || pt.key === mt.curr_key) return;
				if(mt.curr_key){
					mt.parts[mt.curr_key].$tab.removeClass('current');
					mt.parts[mt.curr_key].$cont.hide();
				}
				mt.curr_key = key;
				pt.$tab.addClass('current');
				pt.$cont.show();
			}

		},
		changeData:function(name,value){
			if(me.data[name] !== value){
				me.post_data[name] = value;
			}else{
				if(typeof me.post_data[name] !== 'undefined'){
					delete me.post_data[name];
				}
			}
		},
		save:function(){
			if($.isEmptyObject(me.post_data)){
				$.wlDialog.warn('当前无修改，无须保存!');
				return;
			}
			$.wlDialog.confirm('是否确定保存当前修改的配置?')
				.yes(function(){
					$.postJSON(me.link('admin/config/doSave'),{data:me.post_data})
						.success(function(json){
							if(json && json.result){
								$.each(me.post_data,function(k,v){
									me.data[k] = v;
								});
								me.post_data = {};
								$.wlDialog.success(json.msg || '保存成功');
							}else{
								$.wlDialog.error(json.msg || '保存失败');
							}
						});
				});
		}
	});
	return me.init();
});