<?php
/**
* 辅助函数库 - 常规
* @copyright(c) 2016
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2016-4-14
*/

function wl_lang($key){
	return cc()->lang->get($key);
}

/** json格式输出内容 */
function json_out($result,$data=NULL,$msg='',$other_data=NULL){
	$ret = array(
			'result'=> $result?true:false,
			'data'  => $data,
			'msg'   => $msg
	);
	if($other_data){
		$ret=array_merge($ret,$other_data);
	}
	echo(json_encode($ret));
}

/**
 * json 格式输出成功结果
 */
function json_result($data='',$msg=''){
	json_out(true,$data,$msg);
}
/**
 * json 格式输出失败结果
 */
function json_error($msg=''){
	json_out(false,NULL,$msg);
}


/** 消息提示页面  **/
function show_page($page='common',$data=array()){
	$ci =& cc();
	$data = array_merge(array(
				'title'	=>	'Info'
			
			),$data);
	if(!empty($data))$ci->assign($data);
	$ci->display('show_pages/'.$page);
	exit;
}
/**
 * 合并数组
 * 与array_merge不同的时,新数组保持和第一个数组一样的键
 */
function array_merge2(){
	$arrs = func_get_args();
	if(empty($arrs)) return array();
	$ret = array_shift($arrs);
	if(empty($arrs)) return $ret;
	foreach ($arrs as $i=>$arr){
		foreach($arr as $k=>$v){
			if(key_exists($k, $ret)){
				$ret[$k] = $v;
			}
		}
	}
	return $ret;
}
/**
 * 返回设置验证码
 */
function captcha_code($key='default',$value=null){
	$key = 'captcha_code_'.htmlspecialchars($key);
	if($value !== null){
		$_SERVER[$key] = $value;
		return $value;
	}else{
		return isset($_SERVER[$key])?$_SERVER[$key]:NULL;
	}
}


/** 
 * 返回文件后缀名 **/
function fileext($filename) {
	return trim(substr(strrchr($filename, '.'), 1, 10));
}

/**
 * 生成url
 */
function make_url($data,$type='article'){
	$url = site_url();
	switch ($type){
		case 'article':
			$url = site_url('content/article/'.$data['aid']);
			break;
		case 'column':
			
			break;
		default:break;
	}
	return $url;
}

/**
 * 解析生成分页数据
 */
function make_pager($opts=array()){
	$opts = array_merge(array(
				'baseUrl'	=>	'/',
				'pages'		=>	1,
				'page'		=>	1,
				'pageParamName'	=> 'p'
			),$opts);
	$hasp = strpos($opts['baseUrl'],'?') === false?!1:!0; 
	$url = $opts['baseUrl'] . ($hasp?'&':'?') . $opts['pageParamName'] . '=';
	
	$list = array();
	//当前页，前后五页
	for($i=$opts['page']-2;$i<=$opts['page']+2;$i++){
		if($i>0 && $i<=$opts['pages']){
			$list[] = array(
					'page'	=>	$i,
					'url'	=>	$url . $i,
					'current'	=>	$i == $opts['page']	? !0:!1
				);
		}
	}
	//左方省略号
	if($opts['page']>=5){
		array_unshift($list, array('is_ellipsis'=>!0));
	}
	//第一页
	if($opts['page']>3){
		array_unshift($list, array(
					'page'	=>	1,
					'url'	=>	$url . 1,
					'current'	=>	1 == $opts['page']	? !0:!1
				));
	}
	//右方省略号
	if($opts['page']<=$opts['pages']-4){
		array_push($list, array('is_ellipsis'=>!0));
	}
	//最后一页
	if($opts['page']<$opts['pages']-2){
		array_push($list, array(
					'page'	=>	$opts['pages'],
					'url'	=>	$url . $opts['pages'],
					'current'	=>	$opts['pages'] == $opts['page']	? !0:!1
				));
	}
	//上一页
	$prev = false;
	if($opts['page'] > 1){
		$prev = array(
					'page'	=>	$opts['page']-1,
					'url'	=>	$url . ($opts['page']-1)
				);
	}
	//下一页
	$next = false;
	if($opts['page'] < $opts['pages']){
		$next = array(
				'page'	=>	$opts['page']+1,
				'url'	=>	$url . ($opts['page']+1)
		);
	}
	return array_merge($opts,array(
			'prev'	=>	$prev,
			'list'	=>	$list,
			'next'	=>	$next
		));
}










