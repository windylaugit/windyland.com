/** 
 * 
 */

define(function(require,exports,module){
	var me = require('js/me');
	var PV = require('PV');
	
	me.C({
		
		init:function(){
			me.init_eles();
			
		},
		init_eles:function(){
			me.eles = {
				$form:$('#loginForm').submit(function(){return false;}),
				$user:$('#loginForm [name="user"]'),
				$pwd:$('#loginForm [name="password"]'),
				$submit:$('#doLogin').click(function(){me.login();return false;}),
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
		}
		
	});
	return me.init();
});