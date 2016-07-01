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
	
	/* 语言项*/
	var L = window.Lang;
	me.extend({
		init:function(){
			me.init_eles();
			me.init_form();
			me.init_validation();
		},
		init_eles:function(){
			me.eles = {
					$form : $('#j_form'),
					$submit:$('#j_submit').click(function(){ me.submit(); }),
					$cancel:$('#j_cancel').click(function(){ me.cancel();})
				}
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
			if(!data) return false;
			$.ajax({
				url:me.link('admin/column/doAdd'),
				type:'POST',
				dataType:'JSON',
				data:data,
				success: function(json){
					if(json && json.result){
						$.wlDialog.success(json.msg || '新增成功')
									.buttonClick(function(){
										window.location.reload();
									},'ok');
					}else{
						$.wlDialog.warn(json && json.msg?json.msg:'新增失败');
					}
				},
				error:function(){
					$.wlDialog.error('服务器响应失败','错误');
				}
			});	
		},
		cancel:function(){
			me.parent().closeLayer();
		}
		
	});	
	return me.init();
});