/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('jquery');
	require('ui/wlGrid/wlGrid.all');
	require('css!ui/wlGrid/wlGrid.all');
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');

	var layer = require('libs/layer/2.1/layer.factory');
	require('css!libs/layer/2.1/skin/layer');

	var me = require('js/me');
	
	
	me.C({
		columns:[
			{display:'标题',width:250,name:'title'},
			{display:'作者',width:90,name:'author',align:'center'},
			{display:'所属栏目',width:120,name:'c_name',align:'center'},
			{display:'发布时间',width:150,name:'in_time',align:'center'},
			{display:'修改时间',width:150,name:'up_time',align:'center'},
			{display:'操作',width:180,name:'operation',align:'center'},
		
		],
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#j_article_list'),
					$add:$('#j_add').click(function(){me.addArticle();})
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlGrid({
					url:'/admin/content/article/getList',
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
							me.editArticle(rowData.aid);
							return false;
					});
				$del = $('<a href="javascript:;">删除</a>').click(function(){
							me.delArticle(rowData.c_id);
							return false;
					});
				return $('<div></div>').append($edit,'&emsp;',$del);
			}
		},
		addArticle:function(){
			me.layerObj= layer.open({
				type: 2,
				title: '发布文章',
				content: me.link('admin/content/article/add')
			});
			layer.full(me.layerObj);
		},
		closeLayer:function(){
			if(me.layerObj){
				layer.close(me.layerObj);
			}
		},
		/* 编辑文章 */
		editArticle:function(id){
			me.layerObj= layer.open({
				type: 2,
				title: '编辑文章',
				content: me.link('admin/content/article/edit/'+id)
			});
			layer.full(me.layerObj);
		},
		/* 删除文章 */
		delArticle:function(id){
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