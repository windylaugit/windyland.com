/**
 * 文件、附件管理
 */

define(function(require,exports,module){
	/* ui插件 */
	var $ = require('jquery');
	require('ui/wlGrid/wlGrid.all');
	require('css!ui/wlGrid/wlGrid.all');
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');
	require('ui/wlMenu/wlMenu.all');
	require('css!ui/wlMenu/wlMenu.all');
	var layer = require('libs/layer/2.1/layer.factory');
	require('css!libs/layer/2.1/skin/layer');

	var pv = require('PAGEVAL'),
		me = require('js/me');
	
	
	me.extend({
		config:$.extend({
			multiSelectAble:!1,//是否开启多选
			fileTypes:''//筛选的文件类型
		},pv.config||{}),
		init:function(){
			me.init_eles();
			me.Layout.init();
			me.Menu.init();
			me.List.init();
			me.Info.init();
			return me;
		},
		init_eles:function(){
			me.eles = {
				$list:$('#j_files_list'),
				$panel:$('#j_files_panel')
			}
		},
		Layout:{
			init:function(){
				var ml = this;
				$(window).resize(ml.resize);
				ml.resize();
			},
			resize:function(){
				var wh = $(window).height(),
					lh = wh - me.eles.$list.offset().top // top to window of list
							- 10 * 2// padding of list
							- 2 	// border of list
							- 120 // height of panel;
							- 20; //padding-bottom of page-container
				me.eles.$list.height(lh)
			}
		},
		bytesToSize:function(bytes) {
			bytes = parseInt(bytes); 
	    	if (bytes === 0) return '0 B';  
	        var k = 1024;  
	        sizes = ['B','KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];  
	        i = Math.floor(Math.log(bytes) / Math.log(k));
		    return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];   
		},
		Menu:{
			thisId:null,
			init:function(){
				var mm = this;
				mm.menu = $.wlMenu({
					items:mm.items,
					onAfterHide:function(){ mm.thisId = null;}
				});
			},
			items:[
				{id:'select',text:'选中',onclick:function(){ me.Menu.selectItem();}},
				{id:'edit',text:'编辑',onclick:function(){ me.Menu.editItem();}},
			],
			selectItem:function(){
				var mm = this;
			},
			editItem:function(){

			},
			show:function(id,left,top){
				if(!id) return;
				this.thisId = id;
				this.menu.show(left,top);
			}

		},
		Uploader:{
			isUploading:!1,
			txt:{
				normal:'<i class="Hui-iconfont Hui-iconfont-add"></i>&nbsp;上传文件',
				active:'<i class="Hui-iconfont Hui-iconfont-add"></i>&nbsp;上传中...'
			},
			init:function(m){
				var mu = this;
				$.extend(mu,{
					url:me.link('admin/files/doUpload'),
					$form:$('<form>'),
					$file:$('#j_upload_ipt').change(function(){  mu.upload();}),
					$text:$('#j_upload_text')
				});
				mu.$file.wrap(mu.$form);
			},
			uploading:function(b){
				var mu = this;
				if(b){
					mu.$text.html(mu.txt.active);
					mu.isUploading = !0;
				}else{
					mu.$text.html(mu.txt.normal);
					mu.isUploading = !1;
				}
			},
			reset:function(){
				
			},
			upload:function(){
				var mu = this;
				if(mu.isUploading) return;
				if(!mu.$file.val()) return;
				mu.uploading(!0);

				var formData = new FormData(mf.$form[0]);
				formData.append('importKey',m._conf.importKey);

				$.ajax({
					url: mu.url,
					type: 'POST',
					dataType: 'JSON',
					data: formData, 
					cache: false,  
					contentType: false,  
					processData: false
				})
				.always(function(){
					mu.uploading(!1);
				})
				.done(function(json) {
					if(json && json.result){
						$.wlDialog.success('上传成功',1000).on('timeout',function(){ me.List.load();})
					}else{
						$.wlDialog.warn(json.msg || '上传失败');
					}
				})
				.fail(function(a,b,c) {
					$.wlDialog.warn('上传发生错误');
				});
			}
		},
		List:{
			data:{},lastSelectedId:null,
			init:function(){
				var ml = this;
				ml.load();
			},
			empty:function(){
				this.data = {};
				me.eles.$list.empty();
				return this;
			},
			createItem:function(row){
				var ml = this,
					imgPattern = /^(png|jpe?g|bmp|gif)$/i;
				$.extend(row,{
					type:row.file_ext,
					title:row.original_name,
					selected:false,
					isImage:imgPattern.test(row.file_ext)?!0:!1,
					$item:$('<div>').addClass('file-item').attr('title',row.original_name)
									.on('contextmenu',function(e){ me.Menu.show(row.file_id,e.pageX,e.pageY);return false;})
									.click(function(){ ml.select(row.file_id);}),
					$prev:$('<div>').addClass('file-item-prev'),
					$selectTag:$('<div class="file-item-selected-tag"></div>')
				});
				if(row.isImage){
					row.$prev.append(
						$('<img>').attr('src',row.file_url)
					);
				}else{
					row.$prev.addClass('file-type-'+row.file_ext)
							 .append('<span>'+row.title+'</span>');
				}
				row.$item.append(row.$prev,row.$selectTag);
				return row;
			},
			getFilter:function(filter){
				filter = $.extend({
					file_ext : me.config.fileTypes||''
				},filter||{});
				return filter;
			},
			setData:function(data){
				var ml = this;
				ml.empty();
				if(data.Rows.length){
					$.each(data.Rows,function(i,row){
						row = ml.createItem(row);
						ml.data[row.file_id] = row;
						me.eles.$list.append(row.$item);
					});
				}else{
					me.eles.$list.append('<span>未找到文件</span>');
				}
			},
			load:function(filter,page,pageSize){
				var ml = this;
				filter = ml.getFilter(filter);
				$.ajax({
					type:'POST',
					url:me.link('admin/files/getList'),
					dataType:'JSON',
					data:{
						filter:filter,
						page:page||1,
						pageSize:pageSize||100
					}
				})
				.success(function(json){
					if(json && json.result){
						ml.setData(json.data);
					}else{
						$.wlDialog.warn(json.msg || '获取数据失败');
					}
				})
				.error(function(){
					$.wlDialog.error('请求错误！');
				})
			},
			updateRow:function(file_id,uData){
				var ml = this,
					it = ml.data[file_id];
				if(!it || !uData) return;
				$.each(uData,function(k,v){
					ml.data[file_id][k] = v;
				});
			},
			select:function(file_id){
				var ml = this,
					it = ml.data[file_id];
				if(!file_id || !it) return;
				it.selected = !it.selected;
				it.$item.toggleClass('file-item-selected',it.selected);
				if(!me.config.multiSelectAble && ml.lastSelectedId && ml.lastSelectedId !== file_id){
					//非多选模式取消上一个选择
					var lastIt = ml.data[ml.lastSelectedId];
					lastIt.selected = !1;
					lastIt.$item.removeClass('file-item-selected');
				}
				ml.lastSelectedId = file_id;
				me.Info.show({
					file_id:file_id,
					original_name:it.original_name,
					file_size:it.file_size_c,
					add_time:it.add_time_c
				});
			}
		},
		Info:{
			curr:null,
			changedData:{},
			init:function(){
				var mi = this;
				$.extend(mi,{
					$form:$('#j_info_form'),
					$name:$('#j_info_file_name').change(function(){
						me.Info.onChange('original_name',$(this).val());
					}),
					$size:$('#j_info_file_size'),
					$add_time:$('#j_info_add_time'),
					$save:$('#j_info_save').click(function(){ mi.save();}),
					$cancel:$('#j_info_cancel')
				});
			},
			onChange:function(name,val){
				var mi = this;
				if(!mi.curr) return;
				if(val === mi.curr[name]){
					if(mi.changedData[name]) delete(mi.changedData[name]);
				}else{
					mi.changedData[name] = val;
				}
			},
			show:function(info){
				var mi = this;
				if(!info || !info.file_id) return false;
				mi.curr = info;
				mi.changedData = {};
				mi.$name.val(info.original_name);
				mi.$size.val(info.file_size);
				mi.$add_time.val(info.add_time);
			},
			save:function(){
				var mi = this,
					postData = $.extend({},mi.changedData);
				if(!mi.curr || $.isEmptyObject(postData)) return;
				postData.file_id = mi.curr.file_id;

				$.postJSON(
					me.link('admin/files/doSave'),
					{data:postData}
				)
				.success(function(json){
					if(json && json.result){
						$.wlDialog.success(json.msg || '保存成功');
						me.List.updateRow(postData.file_id,postData);
						mi.show($.extend(postData,mi.curr));
					}else{
						$.wlDialog.warn(json.msg || '保存失败');
					}
				})
				.error(function(){
					$.wlDialog.error('保存错误');
				})
			}
		},
		getSelecteds:function(){
			var sel = [];
			$.each(me.List.data,function(id,it){
				if(it.selected){
					sel.push(it);
				}
			});
			return sel;
		},
		getSelected:function(){
			var ret = null;
			$.each(me.List.data,function(id,it){
				if(it.selected){
					ret = it;
					return false;
				}
			});
			return ret;
		}
	});
	module.exports = me.init();
	return me;
});