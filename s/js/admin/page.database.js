/**
 * 
 */
define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlTable');
	require('ui/wlDialog/wlDialog');
	require('css!ui/wlDialog/wlDialog.all');
	var me = require('js/me');
	var PV = require('PAGEVAL');
	me.baseUrl(PV.baseUrl);
	me.C({
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#table_list'),
					$backupAll:$('#backupAll').click(function(){me.backup(true);}),
					$backupSelected:$('#backupSelected').click(function(){me.backup(false);})
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
		backup:function(ifall){
			var msg = '确定要备份'+(ifall?'全部':'这些')+'数据表么？';
			var do_tables = false;
			if(!ifall){
				var rows = me.grid.getSelecteds();		
				do_tables = $.map(rows,function(r){return r.rowdata.table_name;});
				if(do_tables.length<1){
					$.wlDialog.alert('请至少选择一张表！');
					return;	
				}
			}
			$.wlDialog.confirm(msg,function(yes){
				if(yes){
					$.ajax({
							url:me.link('doBackup'),
							type:'POST',
							data:{
									ifall:ifall?1:0,
									tables:do_tables
								},
							dataType:"JSON",
							success:function(json){
								
							},
							error:function(){
									
							}
						});
				}
			});
		}
		
		
	});
	
	return me.init();
});