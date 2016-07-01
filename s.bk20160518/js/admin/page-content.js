/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlTable');
	
	var me = require('js/me');
	
	
	me.C({
		columns:[
			{display:'ID',width:40,name:'id'},
			{display:'栏目名称',width:200,name:'name'},
		
		],
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#column_list')
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlTable({
					columns:me.columns,
					checkbox:true,
					multiLevel:true,
					multiLevelColumn:'name'
				});
			/* 添加数据 */
			me.grid.load([
				
				{id:1006,name:"下载中心3-1",pid:1005},
				{id:1003,name:"下载中心1",pid:1002},
				{id:1001,name:"编程技术"},
				{id:1004,name:"下载中心2",pid:1002},
				{id:1002,name:"下载中心"},
				{id:1005,name:"下载中心3",pid:1002},
			
			]);
				
			
		}
		
		
	});
	
	return me.init();
});