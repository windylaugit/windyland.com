/**
 * 
 */

define(function(require,exports,module){
	/* ui插件 */	
	var me = require('js/me');
	
	/* 表单验证插件 */
	require('js/ui/wlValidate');
	
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
					$form : $('#addForm'),
					$submit:$('#submit')
				}
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
							val:function(){return f.$input.val();}
						}
					me.fields[name] = f;
			});
			
		},
		init_validation:function(){
			var e = L.errors;
			me.eles.$form.wlValidate({
				events:'keyup',
				rules:{
						c_name:{
									required:true,
									maxlength:6
								},
						alias:{
									required:true,
									maxlength:10
								},
						sort_order:{
									required:true,
									digits:true,
									range:[1,255]
								}
					},
				messages:{
						c_name:{
									required:e.name_required||'Column name required',
									maxlength:e.name_maxlength
								},
						alias:{
									required:e.alias_required
								},
						sort_order:{
									required:e.sort_required,
									range:e.sort_range,
									digits:e.sort_digits
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
		}
		
		
	});
	/* 抛出公共方法 */
	window.getData = me.getData;
	
	return me.init();
});