/**
 * 
 */
define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlGrid');
	var me = require('js/me');
	var PV = require('PAGEVAL');
	me.C({
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#backup_list')
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlGrid({
					columns:me.render._renderColumns($.parseJSON(PV.columns_json)),
					checkbox:true,
					url:'/admin/database/getBackupList',
					root:'data',
					onSuccess:function(data){
						me.data = {};
						$.each(data.data,function(row){
							me.data[row.id]	= row;
						});
						return data;
					}
				});
			/* 添加数据 */
			me.grid.loadServer();
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
		/* 还原 */
		rebuild:function(id){
			if(me.data[id]){
				
					
			}
		}
		
	});
	
	return me.init();
});