define(function(require,exports,module){
	require('ui/wlDialog/wlDialog.121.all');
	require('css!ui/wlDialog/wlDialog.all');


	var me = module.exports = {
		init:function(conf){
			me.conf = $.extend({
				listUrl:'/comment/getContentComments',
				postUrl:'/comment/getContentComments'
			},conf||{});
			me.init_eles();
			me.load();
			return me;
		},
		init_eles:function(){
			var $box = $('[data-use-comment]');
			me.eles = {
					$box : $box,
					$name:$('$#j_comt_name',$box),
					$count:$('#j_comt_count',$box),
					$cont_id:$('#j_comt_cont_id',$box),
					$cont:$('#j_comt_cont',$box),
					$submit:$('#j_comt_submit',$box).click(function(){ me.doSubmit();}),
					$list:$('#j_comt_list',$box)
				}
			me.cont_id = me.eles.$cont_id.val();			
		},
		load:function(page,pageSize){
			if(me.loading) return;
			me.loading = true;
			page = page || 1;
			pageSize = pageSize || 5;
			$.ajax({
				url: me.conf.listUrl,
				type: 'POST',
				dataType: 'JSON',
				data: {
					page:page,
					pageSize:pageSize,
					cont_id:me.cont_id
				}
			})
			.complete(function(){ me.loading = false;})
			.success(function(json){
				if(json && json.result){
					me.setData(json.data);
				}else{
					me.eles.$list.html('<h4>暂无评论！</h4>');
				}
			});
		},
		setData:function(data){
			if(!data||!data.rows)return;
			if(!data.rows.length){
				me.eles.$list.html('<h4>暂无评论！</h4>');
				return;
			}
			me.eles.$count.text(data.total||0);

		},
		doSubmit:function(){
			var data = {
				cont_id:me.cont_id,
				name : me.eles.$name.val(),
				content:me.eles.$cont.val()
			}
			if(!data.name){
				$.wlDialog.warn('请输入您的昵称');
				return;
			}
			if(!data.content){
				$.wlDialog.warn('请输入评论内容');
				return;
			}
		}
	};

	return me;
});