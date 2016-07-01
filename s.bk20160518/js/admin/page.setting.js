/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlDialog/wlDialog');
	require('css!ui/wlDialog/wlDialog.all');
	var me = module.exports = require('js/me');
	
	
	me.C({
		init:function(){
			me.init_eles();

			return me;
		},
		init_eles:function(){
			me.eles = {
					$form:$('#postForm'),
					$submit:$('#submit').click(function(){ me.save();})
				}	
		},
		save:function(){
			var data = me.eles.$form.serializeObject();
			if(!data) return false;
			$.wlDialog.confirm('是否确定保存基本配置?')
				.yes(function(){
					$.postJSON(me.link('admin/config/doSaveBase'),{data:data})
						.success(function(json){
							if(json && json.result){
								$.wlDialog.success(json.msg || '保存成功');
							}else{
								$.wlDialog.alert(json.msg || '保存失败');
							}
						});
				});
		}
	});
	return me.init();
});