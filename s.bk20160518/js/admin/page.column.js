/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('ui/wlGrid');
	require('ui/wlDialog/wlDialog');
	require('css!ui/wlDialog/wlDialog.all');
	var me = require('js/me');
	
	
	me.C({
		columns:[
			{display:'ID',width:40,name:'c_id'},
			{display:'栏目名称',width:200,name:'c_name'},
			{display:'栏目内容',width:200,name:'column_content',align:'center'},
			{display:'排序',width:80,name:'sort_order',align:'center'},
			{display:'操作',width:200,name:'operation',align:'center'},
		
		],
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#column_list'),
					$add:$('#add_column').click(function(){me.addColumn();})
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlGrid({
					url:'/admin/column/getList',
					columns:me.render._renderColumns(me.columns),
					root:'data',
					checkbox:true,
					//multiLevel:true,
					//multiLevelColumn:'c_name',
					//idField:'c_id',
					//pidField:'parent_id'
				});
			/* 添加数据 */
			me.grid.loadServer();
		},
		/* 列渲染器 */
		render:{
			_renderColumns:function(columns){
				$.each(columns,function(i,col){
					if(me.render[col.name]){
						columns[i].render = me.render[col.name];	
					}	
				});
				return columns;
			},
			c_name:function(rowData,index,value){
				var pre = rowData.level?new Array(rowData.level+1).join('&emsp;&emsp;'):'';
				return pre + value;
			},
			operation:function(rowData){
				$edit = $('<a href="javascript:;">编辑</a>').click(function(){
							me.editColumn(rowData.c_id);
							return false;
					});
				$del = $('<a href="javascript:;">删除</a>').click(function(){
							me.delColumn(rowData.c_id);
							return false;
					});
				return $('<div></div>').append($edit,'&emsp;',$del);
			}
		},
		addColumn:function(){
			var btnOk = $.wlDialog.button('保存',function(wld){
				var fn = wld.get('getData');
				if(fn){
					var data = fn();
					if(!data) return false;
					$.ajax({
						url:'/admin/column/doAdd',
						type:'POST',
						dataType:'JSON',
						data:data,
						success: function(json){
							if(json && json.result){
								$.wlDialog.alert(json.msg || '新增成功','提示');
								me.grid.loadServer();
								wld.close();
							}else{
								$.wlDialog.alert(json && json.msg?json.msg:'新增失败');
							}
						},
						error:function(){
							$.wlDialog.alert('服务器响应失败','错误');
						}
					});
					
				}
			});
			$.wlDialog.open({
				title:'新增栏目',
				url:'/admin/column/add',
				width:700,
				height:370,
				buttons:[
					btnOk,
					$.wlDialog.button.close()
				]	
			});	
		},
		/* 编辑栏目 */
		editColumn:function(id){
			var btnOk = $.wlDialog.button('保存',function(wld){
				var fn = wld.get('getData');
				if(fn){
					var data = fn();
					if(!data) return false;
					$.ajax({
						url:'/admin/column/doEdit/'+id,
						type:'POST',
						dataType:'JSON',
						data:data,
						success: function(json){
							if(json && json.result){
								$.wlDialog.alert(json.msg || '编辑成功','提示');
								me.grid.loadServer();
								wld.close();
							}else{
								$.wlDialog.alert(json && json.msg?json.msg:'编辑失败');
							}
						},
						error:function(){
							$.wlDialog.alert('服务器响应失败','错误');
						}
					});
					
				}
			});
			$.wlDialog.open({
				title:'编辑栏目',
				url:'/admin/column/edit/'+id,
				width:700,
				height:370,
				buttons:[
					btnOk,
					$.wlDialog.button.close()
				]	
			});	
		},
		/* 删除栏目 */
		delColumn:function(id){
			$.wlDialog.confirm('确定删除该栏目么？',function(yes){
				if(yes){
					$.ajax({
						url:'/admin/column/doDel/'+id,
						type:'POST',
						dataType:'JSON',
						success: function(json){
							if(json && json.result){
								$.wlDialog.alert(json.msg || '删除成功','提示');
								me.grid.loadServer();
							}else{
								$.wlDialog.alert(json && json.msg?json.msg:'删除失败');
							}
						},
						error:function(){
							$.wlDialog.alert('服务器响应失败','错误');
						}
					});	
				}	
			});
		}
		
		
	});
	
	return me.init();
});