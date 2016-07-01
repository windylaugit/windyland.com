/** 
 * 
 */

define(function(require,exports,module){
	var me = require('js/me');
	var PV = require('PV');
	
	me.C({
		
		init:function(){
			me.init_eles();
			return me;
		},
		init_eles:function(){
			me.eles = {
				$form:$('#j_login_form').submit(function(){return false;}),
				$user:$('#j_login_user'),
				$pwd:$('#j_login_password'),
				$captcha:$('#j_login_captcha').click(function(){ me.refreshCaptcha()}),
				$submit:$('#j_login_submit').click(function(){me.login();return false;}),
			}
		},
		login:function(){
			var data = {
					username:me.eles.$user.val(),
					password:me.eles.$pwd.val()
			}
			if(!data.username || !data.password){
				alert('user_pwd_empty');
				return false;
			}
			$.post(
					me.link(PV.login_url),
					data,
					function(json){
						if(json && json.result){
							me.redirect(PV.success_url);
						}else{
							var msg = (json && json.msg)?json.msg:'login_failure!';
							alert(msg);
						}
					},
					'JSON'
			);
			return false;
		},
		refreshCaptcha:function(){
			me.eles.$captcha.find('img').attr('src','/captcha/login.png?_='+(new Date()).getTime());
		}
		
	});
	module.exports = me.init();
});