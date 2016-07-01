/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-07-08
*/
(function(factory){
	if(typeof define === 'function' && define.amd){
		define(['jquery'],factory);
	}else{
		factory(jQuery);
	}
})(function($){
	"use strict";

$.fn.extend({
	wlGrid:function(conf){
		var $dom = $($(this).get(0));
		
		var me = {
				conf:{
					columns:[],
					checkbox:false,
					rownumbers:true,//是否显示行序号
					root:'Rows',
					idField:'id',
					pidField:'pid',
					multiLevel:false,
					multiLevelColumn:'',
					render:{},
					url:'',//url获取方式
					type:'post',
					onSuccess:function(data){return data;},
					onError:function(msg,data){}
				},
				def_column:{
					display:'',//显示标题
					name:'',//数据字段名
					align:'left',//对齐方式
					width:100,//宽度
					render:null,//渲染函数
					sort:null// null-不支持排序,asc-升序,desc-降序,all-全部
				},
				headers:{},
				data:{},
				init:function(){
					me.conf = $.extend(me.conf,conf,{columns:[]});
					$.each(conf.columns,function(i,col){
						me.conf.columns.push($.extend({},me.def_column,col));	
					});
					me.init_eles();
					
					return me;
				},
				init_eles:function(){
					me.eles = {
							$table:$('<table class="table table-striped table-bordered table-hover wlg-table"></table>'),
							$thead:$('<thead>').addClass('wlg-thead'),
							$tbody:$('<tbody>').addClass('wlg-tbody'),
							$checkall:$('<input type="checkbox" / >').click(function(){
									me.checkAll($(this).prop('checked')?true:false);
								})/* 全选 */
						}
					me.eles.$table.append(
						me.eles.$thead.append(me.createHeader()),
						me.eles.$tbody
					);

					$dom.html(me.eles.$table);
				},
				createHeader:function(){
					me.headers = {};
					//创建列表头
					var $tr = $('<tr></tr>');
					/* 行序号 */
					if(me.conf.rownumbers){
						me.headers['_rownumbers'] = {
							$th : $('<th>').addClass('wlg-col-number')
						}
						$tr.append(me.headers['_rownumbers'].$th);
					}
					/* 行选择 */
					if(me.conf.checkbox){
						me.headers['_checkbox'] = {
							$th : $('<th>').addClass('wlg-col-checkbox').append(me.eles.$checkall).width(30)
						}
						$tr.append(me.headers['_checkbox'].$th);	
					}
					$.each(me.conf.columns,function(i,col){
						var $th = col.$th = $('<th>').html(col.display).css({
									'text-align':col.align,
									'width':col.width
								});
						if(col.sort){
							var cls = '';
							if(col.sort == 'asc'||col.sort == 'all') cls += 'wlg-sort-asc ';
							if(col.sort == 'desc'||col.sort == 'all') cls += 'wlg-sort-desc';
							var $sort_tag = $('<div>').addClass(cls);
							$th.append($sort_tag).click(function(){ me.sorting(col.name)})
						}
						me.headers[col.name] = col;
						$tr.append($th);
					});
					$tr.append('<th>');
					return $tr;
				},
				createRow:function(rowdata,i){
					if(!rowdata) return false;
					var $tr = $('<tr></tr>');
					if(me.conf.rownumbers){
						$tr.append($('<td class="wlg-col-number">'+i+'</td>'));
					}
					if(me.conf.checkbox){
						$tr.append($('<td class="wlg-col-checkbox"></td>').append('<input type="checkbox" / >').width(30));		
					}
					var lvCol = me.conf.multiLevel && me.conf.multiLevelColumn?me.conf.multiLevelColumn:null;
					$.each(me.conf.columns,function(i,col){
						var value = rowdata[col.name] || '';
						if(col.render){
							if(typeof col.render == 'string') col.render = me.conf.render[col.render]||null;
							if(col.render) value = col.render(rowdata,i,value);	
						}else if(me.conf.render[col.name]){
							value = me.conf.render[col.name](rowdata,rowdata,i,value);
						}
						var $td = $('<td></td>');
						if(col.align !== 'left'){
							$td.css('text-align',col.align);	
						}
						
						if(lvCol && col.name == lvCol && rowdata.__level){
							var str = new Array(rowdata.__level+1).join('&emsp;&emsp;') + '<i class="icon-chevron-right"></i>';
							$td.append(str);
						}
						$tr.append($td.append(value));
					});
					$tr.append('<td></td>');
					return $tr;
				},
				/*分级排序数据*/
				getMultiLevelData:function(alldata){
					var idf = me.conf.idField;
					var pif = me.conf.pidField;
					if(!idf || !pif) return data;
					/* 递归从顶层往下找子集 */
					var func = function(data,pid,lv){
						var _finds = [];var _subs = [];
						var _findNums = 0;
						$.each(data,function(i,d){
								if((!pid && !d[pif] || d[pif] == '0')||(pid && d[pif]==pid)){
									d.__level = lv;
									_finds.push(d);
									_findNums ++;
								}else{
									_subs.push(d);	
								}
						});
						if(_subs.length){
							var _finds2 = [];
							$.each(_finds,function(i,o){
								_finds2.push(o)
								var ret = func(_subs,o[idf],lv+1);
								_finds2[i].__childNums = ret[1];
								_finds2 = $.merge(_finds2,ret[0]);	
							});
							_finds = _finds2;
						}
						return [_finds,_findNums];
					}
					var ret = func(alldata,null,0);
					return ret[0];
				},
				/* 直接读取数据 */
				loadData:function(data){
					if(!data)return me;
					if(me.conf.multiLevel) data = me.getMultiLevelData(data);
					var $trs = [];
					var _data = {},rows=0;
					$.each(data,function(i,rowdata){
						var $tr = me.createRow(rowdata,i+1);
						if($tr){
							$trs.push($tr);
							_data['r'+rows] = {
									__id:'r'+rows,
									__$tr:$tr,
									rowdata:rowdata
									
								};
							rows++;
						}
					});
					
					if(rows){
						me.eles.$tbody.html($trs);
						me.data = _data;
						me.rows = rows;
					}
					return me;
				},
				/* 从url读取数据 */
				loadServer:function(params,conf){
					conf = conf || {};
					$.ajax({
						type:conf.type || me.conf.type,
						url:conf.url || me.conf.url,
						dataType:"JSON",
						data:params||{},
						success: function(data){
							if(data && data.result){
								data = me.conf.onSuccess(data);
								me.loadData(data[me.conf.root||'Rows']);	
							}
							
						},
						error:function(XMLHttpRequest, textStatus, errorThrown){
							me.conf.onError('Server Connection Error',{
									XMLHttpRequest:XMLHttpRequest,
									textStatus:textStatus,
									errorThrown:errorThrown
								});
						}
					});
					return me;
				},
				/** 排序 **/
				sorting:function(name){

				},
				/* 全选 */
				checkAll:function(c){
					if(c !== true && c !== false){
						c = me.eles.$checkall.prop('checked')?false:true;	
					}
					me.eles.$tbody.find('td.row-checkbox input[type="checkbox"]').prop('checked',c);
					return me;
				},
				/* 获得所有数据 */
				getAllData:function(){
					return me.data;	
				},
				getSelecteds:function(){
					var ret = {};
					$.each(me.getAllData(),function(id,dat){
						if(dat.__$tr.find('.row-checkbox input[type="checkbox"]').prop('checked')){
							ret[id] = dat;	
						}
					});
					return ret;
				}
			
		}
		return me.init();
	}
});

});