/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */	
	var me = require('js/me');
	
	/* 表单验证插件 */
	require('js/ui/wlValidate');
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');
	require('ueditor');	
	
	/* 语言项*/
	var L = window.Lang;
	
	me.extend({
		article_id:'',
		init:function(){
			me.init_eles();
			me.init_form();
			me.init_validation();

			window.me = me;
			return me;
		},
		init_eles:function(){
			me.eles = {
					$article:$('article.page-container'),
					$form : $('#j_form'),
					$content : $('#field_content'),
					$submit:$('#j_submit').click($.proxy(me.submit,me)),
					$cancel:$('#j_cancel').click(function(){ me.close();})
				}
			me.article_id = me.eles.$article.attr('data-aid');
			me.ue = UE.getEditor('field_content');
		},
		init_form:function(){
			me.fields = {};
			$('.row-field',me.eles.$form).each(function(i,o){
					var $o = $(o),
						$ipt = $o.find('[name]'),
						name = $ipt.attr('name');
					if(!$ipt.size()) return true;
					var f = {
							name:name,
							$row:$o,
							$ipt:$ipt,
							val:function(){return f.$ipt.val();}
						}
					me.fields[name] = f;
			});
		},
		init_validation:function(){
			var e = L.errors;
			me.eles.$form.wlValidate({
				events:'keyup blur',
				rules:{
						title:{
									required:true,
									maxlength:20
								},
						keywords:{
									required:true,
									maxlength:30
								},
						author:{
									required:true,
									maxlength:10
								}
					},
				messages:{
						title:{
									required:e.title_required,
									maxlength:e.title_maxlength
								},
						keywords:{
									required:e.keywords_required,
									maxlength:e.keywords_maxlength
								},
						author:{
									required:e.author_required,
									maxlength:e.author_maxlength
								}
					},
				onError:function($ipt,value,msg){
					me.showError($ipt.attr('name'),msg);
				},
				onSuccess:function($ipt,value){
					me.hideError($ipt.attr('name'));
				}
				
			});	
		},
		showError:function(name,msg){
			var f = me.fields[name];
			if(!f) return;
			if(!f.$error){
				f.$error = $('<label>').addClass('error').insertAfter(f.$ipt)
										.click(function(){
											me.hideError(name);
											f.$ipt.focus();
										});
			}
			f.$ipt.addClass('error');
			f.$error.text(msg||'error').show();
		},
		hideError:function(name){
			var f = me.fields[name];
			if(!f) return;
			if(f.$error){
				f.$error.hide();
			}
			f.$ipt.removeClass('error');
		},

		getData:function(){
			if(!me.eles.$form.wlValid()) return false;
			var data = {content:me.ue.getContent()};
			if(!data.content){
				$.wlDialog.warn(L.errors.content_required).buttonClick(function(){ me.ue.focus(); });
				return;
			}
			$.each(me.fields,function(name,f){
				data[name] = f.val();
			});
			return data;
		},
		submit:function(){
			var data = me.getData(),
				isNew = me.article_id?!1:!0;
			if(!data)return false;
			if(!isNew){
				var url = me.link('admin/content/article/doEdit/'+me.article_id);
			}else{
				var url = me.link('admin/content/article/doAdd');
			}

			$.ajax({
				url:url,
				type:'POST',
				dataType:'JSON',
				data:{post_data:data}
			})
			.success(function(json){
				if(json && json.result){
					var s = isNew?'发布':'编辑';
					$.wlDialog.success(s + '成功')
						.setButton('ok',{text:'继续'+s,click:function(){  window.location.reload();}})
						.appendButton({id:'close',text:'关闭',click:function(){ me.close(); }});
				}
			})
			.error(function(){
				$.wlDialog.error('保存错误！');
			});			
		},
		close:function(){
			me.parent().closeLayer();
		}
		
		
	});
	/* 抛出公共方法 */
	window.getData = me.getData;
	
	return me.init();
});