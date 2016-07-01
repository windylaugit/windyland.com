/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */
	require('jquery');
	require('ui/wlGrid/wlGrid.all');
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');
	var me = require('js/me');
	
	
	me.C({
		columns:[
			{display:'标题',width:250,name:'title'},
			{display:'作者',width:90,name:'author',align:'center'},
			{display:'所属栏目',width:120,name:'c_name',align:'center'},
			{display:'发布时间',width:150,name:'post_time',align:'center'},
			{display:'操作',width:180,name:'operation',align:'center'},
		
		],
		init:function(){
			me.init_eles();
			me.init_grid();	
		},
		init_eles:function(){
			me.eles = {
					$list:$('#article_list'),
					$add:$('#pub_article').click(function(){me.pubArticle();})
				}	
		},
		init_grid:function(){
			me.grid = me.eles.$list.wlGrid({
					url:'/admin/contentArticle/getList',
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
							me.editArticle(rowData.c_id);
							return false;
					});
				$del = $('<a href="javascript:;">删除</a>').click(function(){
							me.delArticle(rowData.c_id);
							return false;
					});
				return $('<div></div>').append($edit,'&emsp;',$del);
			}
		},
		pubArticle:function(){
			var wld = $.wlDialog.open({
				title:'发布文章',
				url:'/admin/contentArticle/add',
				width:$(window).width()-10,
				height:$(window).height()-10,
				buttons:[
					{text:'发布',id:'pub'},
					{text:'取消',id:'cancel'},
					
					
					$.wlDialog.button.close()
				]

			})

			var btnOk = $.wlDialog.button('发布',function(wld){
				var fn = wld.get('getData');
				if(fn){
					var data = fn();
					if(!data) return false;
					$.ajax({
						url:'/admin/contentArticle/doAdd',
						type:'POST',
						dataType:'JSON',
						data:data,
						success: function(json){
							if(json && json.result){
								$.wlDialog.alert(json.msg || '发布成功','提示');
								me.grid.loadServer();
								wld.close();
							}else{
								$.wlDialog.alert(json && json.msg?json.msg:'发布失败');
							}
						},
						error:function(){
							$.wlDialog.alert('服务器响应失败','错误');
						}
					});
					
				}
			});
			$.wlDialog.open({
				title:'发布文章',
				url:'/admin/contentArticle/add',
				width:$(window).width()-10,
				height:$(window).height()-10,
				buttons:[
					btnOk,
					$.wlDialog.button.close()
				]	
			});	
		},
		/* 编辑栏目 */
		editArticle:function(id){
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