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
	require('ui/wlMenu/wlMenu.all');

	var layer = require('libs/layer/2.1/layer.factory');
	require('css!libs/layer/2.1/skin/layer');

	var me = require('js/me');
	
	
	me.extend({
		init:function(){
			me.init_eles();
			me.Grid.init();
		},
		init_eles:function(){
			me.eles = {
					$add:$('#j_add').click(function(){me.addArticle();}),
					$grid:$('#j_download_list')
				}	
		},
		bytesToSize:function(bytes) {  
	    	if (bytes === 0) return '0 B';  
	        var k = 1024;  
	        sizes = ['B','KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];  
	        i = Math.floor(Math.log(bytes) / Math.log(k));
		    return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];   
		},
		Grid:{
			init:function(){
				var mg = this;
				mg.config = $.extend(mg.config,{
					columns:mg.columns,
					render:mg.render
				});
				mg.grid = me.eles.$grid.wlGrid(mg.config).loadServer();
			},
			config:{
				url:'/admin/content/download/getList',
				root:'data',
				checkbox:true,
				//multiLevel:true,
				//multiLevelColumn:'c_name',
				//idField:'c_id',
				//pidField:'parent_id'
			},
			columns:[
				{display:'标题',width:250,name:'title'},
				{display:'作者',width:90,name:'author',align:'center'},
				{display:'所属栏目',width:120,name:'c_name',align:'center'},
				{display:'文件大小',width:80,name:'file_size',align:'right'},
				{display:'语言',width:100,name:'language',align:'center'},
				{display:'下载次数',width:80,name:'download_times',align:'right'},
				{display:'发布时间',width:150,name:'in_time',align:'center'},
				{display:'修改时间',width:150,name:'up_time',align:'center'},
				{display:'操作',width:180,name:'operation',align:'center'}
			],
			/* 列渲染器 */
			render:{
				c_name:function(rowData,index,value){
					var pre = rowData.level?(new Array(rowData.level+1)).join('&emsp;&emsp;'):'';
					return pre + value;
				},
				file_size:function(r,i,v){
					return me.bytesToSize(parseFloat(v));
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