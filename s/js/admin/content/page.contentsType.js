/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlGrid');
	
	var me = require('js/me');
	
	
	me.C({
		columns:[
			{display:'类型ID',width:100,name:'ctype_id'},
			{display:'类型名称',width:200,name:'ctype_name'},
		
		],
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#ctype_list')
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlGrid({
					url:me.link('admin/contentsType/getList'),
					root:'data',
					columns:me.columns,
				});
			/* 添加数据 */
			me.grid.loadServer();
		}
		
		
	});
	
	exports =  me.init();
});