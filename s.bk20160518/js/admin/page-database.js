/**
 * 
 */
define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlTable');
	var me = require('js/me');
	var PV = require('PAGEVAL');
	me.C({
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#table_list'),
					$backupAll:$('#backupAll').click(function(){me.backupAll();}),
					$backupSelected:$('#backupSelected').click(function(){me.backupSelected();})
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlTable({
					columns:me.render._renderColumns($.parseJSON(PV.columns_json)),
					checkbox:true,
					url:'/admin/database/getList',
					root:'data'
				});
			/* 添加数据 */
			me.grid.loadUrl();
		},
		render:{
			_renderColumns:function(columns){
				$.each(columns,function(i,col){
					if(me.render[col.name]){
						columns[i].render = me.render[col.name];	
					}	
				});
				return columns;
			},
			operation:function(rowdata,index,value){
				return '<a href="javascript:;">查看</a>';
			}
		},
		/* 备份全部数据库 */
		backupAll:function(){
			
		},
		backupSelected:function(){
			
		}
		
		
	});
	
	return me.init();
});