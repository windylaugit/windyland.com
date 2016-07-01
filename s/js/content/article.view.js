/**
 * 
 * @authors AndyLau (i@windyland.com)
 * @date    2016-06-18 16:08:51
 * @version V1.0.1
 */
define(function(require,exports,module){
	require('jquery');	
	var me = require('js/me'),
		pv = require('PAGEVAL');
	
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');

	var comt = require('js/comment/content');

	me.extend({
		init:function(){

			comt.init({
				
			});
		}

	});

	$(function(){
		me.init();
	})

});
