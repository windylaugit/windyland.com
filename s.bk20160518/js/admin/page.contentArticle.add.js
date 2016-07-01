/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */	
	var me = require('js/me');
	
	/* 表单验证插件 */
	require('js/ui/wlValidate');
	require('ueditor');	
	
	/* 语言项*/
	var L = window.Lang;
	
	me.C({
		
		init:function(){
			me.init_eles();
			me.init_form();
			me.init_validation();
		},
		init_eles:function(){
			me.eles = {
					$backTolist : $('#back_tolist').click(function(){
							me.redirect('admin/contentArticle')
						}),
					$form : $('#addForm'),
					$content : $('#field_content'),
					$submit:$('#submit').click(me.submit)
				}
			me.ue = UE.getEditor('field_content');
		},
		init_form:function(){
			me.fields = {};
			$('.form-group',me.eles.$form).each(function(i,o){
					var $input = $(o).find('[name]');
					if(!$input.size()) return true;
					var name = $(o).find('[name]').attr('name');
					
					var f = {
							name:name,
							$group:$(o),
							$input:$input,
							$help:$(o).find('.help-block'),
							val:function(){return $.trim(f.$input.val());}
						}
						
					me.fields[name] = f;
			});
		},
		init_validation:function(){
			var e = L.errors;
			me.eles.$form.wlValidate({
				events:'keyup',
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
								},
						content:{
									required:true
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
								},
						content:{
									required:e.content_required
								}
					},
				onError:function($ipt,value,msg){
					var f = me.fields[$ipt.attr('name')];
					f.$group.addClass('has-error');
					f.$help.html(msg).fadeIn(200);
				},
				onSuccess:function($ipt,value){
					var f = me.fields[$ipt.attr('name')];
					f.$group.removeClass('has-error');
					f.$help.fadeOut(200);
				}
				
			});	
		},
		getData:function(){
			var data = {};
			var valid = me.eles.$form.wlValid();
			if(valid){
				$.each(me.fields,function(name,f){
					data[name] = f.val();
				});
				return data;
			}else{
				return false;	
			}
		},
		submit:function(){
			var data = me.getData();
			if(!data)return false;
			$.ajax({
				url:me.link('admin/contentArticle/doAdd'),
				type:'POST',
				dataType:'JSON',
				data:data,
				success:function(json){
					console.log(json);
					
					
				},
				error:function(){
					
				}
				
				
			});
			
			
		}
		
		
	});
	/* 抛出公共方法 */
	window.getData = me.getData;
	
	return me.init();
});