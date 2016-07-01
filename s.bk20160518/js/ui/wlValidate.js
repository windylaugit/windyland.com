/**
* 表单验证插件 wlValidate
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package WLCMS
* @version V1.0.2
* @date 2015-08-05
*/

(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	} else {
		// Browser globals.
		factory(jQuery);
	}
}(function($){
	$.fn.extend({
		wlValidate:function(conf){
			var $dom = $(this.get(0));
			var me = {
					conf:{
						events:'change',//触发元素验证的一个或多个用空格分隔的事件类型和可选的命名空间
						ignores:[],//忽略验证的元素
						rules:{},//验证规则
						messages:{},//错误消息
						onError:function($ipt,val,msg){},//验证失败事件，每个元素错误时均触发一次
						onSuccess:function($ipt,val){},//验证成功事件，每个元素验证成功时均触发一次
					},
					_rules:{
						required:function(val){return val || val === 0?true:false;},
						maxlength:function(val,args){return val.toString().length <= args?true:false;},
						minlength:function(val,args){return val.toString().length >= args?true:false;},
						rangelength:function(val,args){
								var len = val.toString().length;
								return len >= args[0] && len <= args[1] ? true:false;
							},
						number:function(val){return /^\-?\d+(\.\d+)?$/.test(val.toString())?true:false;},
						digits:function(val){return /^\d+$/.test(val.toString())?true:false;},
						range:function(val,args){
								return val >= args[0] && val <= args[1] ? true:false;
							},
						max:function(val,args){
								return me._rules.number(val) && val <= args ? true:false;
							},
						min:function(val,args){
								return me._rules.number(val) && val >= args ? true:false;
							},
						custom:function(val,func){
								return func(val)?true:false;
							}
					},
					init:function(){
						me.conf = $.extend(me.conf,conf);
						me.init_fields();
						
						
						return me;
					},
					init_fields:function(){
						$('[name]',$dom).each(function(i,o){
								var name = $(o).attr('name');
								if(!me.conf.rules[name]) return true;
								me.bindRule(name,$(o),me.conf.rules[name],me.conf.messages[name]||{});
						});
					},
					bindRule:function(name,$ipt,rules,msgs){
						var valid = function(value){
							value = value !== undefined ? value : $ipt.val(),errMsg='';
							$.each(rules,function(rName,args){
								if(!me._rules[rName]) return true;
								if(!me._rules[rName](value,args)){
									errMsg = msgs[rName]||'Errors:'+rName;
									if($.isArray(args)){
										for(var i = 0;i < args.length;i++){
											errMsg = errMsg.replace('{'+i+'}',args[i]);
										}	
									}else{
										errMsg = errMsg.replace('{0}',args);
									}
									return false;
								}
							});
							if(errMsg){
								me.conf.onError($ipt,value,errMsg);
								return false;	
							}else{
								me.conf.onSuccess($ipt,value);
								return true;
							}
						}
						if(me.conf.events){
							$ipt.on(me.conf.events,function(){valid();});	
						}
						$ipt.attr('wlValidateItem',name).data('wlValidateItem',valid);
					},
					validAll:function(data){
						data = data || {};
						var errNum=0;
						$('[wlValidateItem]',$dom).each(function(i,o){
							var name = $(o).attr('wlValidateItem');
							var valid = $(o).data('wlValidateItem');
							if(!valid) return true;
							if(!valid(data[name])){errNum++;}
						});
						return errNum==0?true:false;
					}
					
				};//end of me
			
			return $dom.attr('wlValidateManager','1').data('wlValidateManager',me.init());
		},
		//执行校验
		wlValid:function(data){
				//执行校验		
			var $dom = $(this.get(0));		
			if($dom.attr('wlValidateManager')){
				var me = $dom.data('wlValidateManager');
				return me.validAll(data);
			}else{
				var errNum = 0;
				$(this).each(function(i,o){
					if($(o).attr('wlValidateItem')){
						var valid = $(o).data('wlValidateItem');
						errNum += valid(data)?0:1;
					}
				})
				return errNum == 0 ? true:false;
			}
			return;
		}
	});//end of extend
}));
