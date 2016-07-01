<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-8
*/

/**
 * 变量中断调试函数
 * @author	AndyLau
 * @date	20150505
 * */
function ddump(){
	$args = func_get_args();
	empty($args) && $args = array('No variables!');
	foreach($args as $k=>$arg){
		echo "<br/>" . str_repeat("*", 50) . "<br/>";
		var_dump($arg);
		echo('<br/>');
	}

	exit();
}


/** 去掉非法字符 */
function remove_invisible_characters($str, $url_encoded = TRUE)
{
	$non_displayables = array();

	// every control character except newline (dec 10)
	// carriage return (dec 13), and horizontal tab (dec 09)

	if ($url_encoded)
	{
		$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
		$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
	}

	$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

	do
	{
		$str = preg_replace($non_displayables, '', $str, -1, $count);
	}
	while ($count);

	return $str;
}

/** 加载控制器基类 */
function load_baseapp($name=''){
	if(is_file(APP_PATH . '/apps.base/' . $name . '.baseapp.php')){
		include(APP_PATH . '/apps.base/' . $name . '.baseapp.php');
	}
}

/** 
 * 当前控制器 
 * @return AppBase
 * */
function &cc(){
	return AppBase::get_instance();
}

/** 按路径，递归获取数组的值 */
function array_deep_get($array,$key,$sep='.'){
	if(empty($array)) return NULL;
	$ret = NULL;
	foreach (explode('.',$key) as $i=>$k){
		if(is_array($array)){
			if(isset($array[$k])){
				$ret = $array[$k];
				$array = $array[$k];
			}else{
				$ret=NULL;
				break;
			}
		}
	}
	return $ret;
}

function is_php($version)
{
	static $_is_php = array();
	$version = (string) $version;

	if ( ! isset($_is_php[$version]))
	{
		$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
	}

	return $_is_php[$version];
}

/**
 * 记录和统计时间（微秒）和内存使用情况
 * 使用方法:
 * <code>
 * G('begin'); // 记录开始标记位
 * // ... 区间运行代码
 * G('end'); // 记录结束标签位
 * echo G('begin','end',6); // 统计区间运行时间 精确到小数后6位
 * echo G('begin','end','m'); // 统计区间内存使用情况
 * 如果end标记位没有定义，则会自动以当前作为标记位
 * 其中统计内存使用需要 MEMORY_LIMIT_ON 常量为true才有效
 * </code>
 * @param string $start 开始标签
 * @param string $end 结束标签
 * @param integer|string $dec 小数位或者m
 * @return mixed
 */
function G($start,$end='',$dec=4) {
	static $_info       =   array();
	static $_mem        =   array();
	if(is_float($end)) { // 记录时间
		$_info[$start]  =   $end;
	}elseif(!empty($end)){ // 统计时间和内存使用
		if(!isset($_info[$end])) $_info[$end]       =  microtime(TRUE);
		if(MEMORY_LIMIT_ON && $dec=='m'){
			if(!isset($_mem[$end])) $_mem[$end]     =  memory_get_usage();
			return number_format(($_mem[$end]-$_mem[$start])/1024);
		}else{
			return number_format(($_info[$end]-$_info[$start]),$dec);
		}

	}else{ // 记录时间和内存使用
		$_info[$start]  =  microtime(TRUE);
		if(MEMORY_LIMIT_ON) $_mem[$start]           =  memory_get_usage();
	}
	return null;
}

/**
 * 日志记录
 * 
 */
function log_message(){
	//@todo 日志记录功能
}

/**
 * 页面重定向
 * */
function redirect($uri = '', $method = 'location', $http_response_code = 302) {
	//if ( isset($_SERVER['argc']) ) return;
	if (!preg_match('#^https?://#i', $uri)) {
		$uri = site_url($uri);
	}
	switch ($method) {
		case 'refresh' : 
			header("Refresh:0;url=" . $uri);
			break;
		case 'location' :
			header("Location: ".$uri, TRUE, $http_response_code);
			break;
		default :
			//header("Location: ".$uri, TRUE, $http_response_code);
			echo '<script type="text/javascript">top.location.href="' . $uri . '";</script>';
			//echo "<script>alert('请重新登录！');window.location.href='".$uri."';</script>";
			break;
	}
	exit;
}

/** 
 * 获取网页url
 * */
function site_url($uri=''){
	$site_url = cc()->config->get('site_url');
	return $site_url . '/' . preg_replace('/^\//','', $uri);;
}

/**
 * 创建目录（如果该目录的上级目录不存在，会先创建上级目录）
 *
 * @param   string  $path  绝对路径
 * @param   int     $mode           目录权限
 * @return  bool
 */
function wl_mkdir($path, $mode = 0777)
{
	$path = preg_replace('/[\/\\\]/', DIRECTORY_SEPARATOR, $path);
	if (is_dir($path)) return true;
	$dirs = array($path);
	while($path && !is_dir(dirname($path))){
		$path = dirname($path);
		array_unshift($dirs, $path);
	}
	foreach ($dirs as $k=>$v){
		if (@mkdir($v, $mode)){
			fclose(fopen($v . '/index.htm', 'w'));
		}else{
			return false;
		}
	}
	
	return true;
}

/**
 * 删除目录,不支持目录中带 ..
 *
 * @param string $dir
 *
 * @return boolen
 */
function wl_rmdir($dir)
{
	$dir = str_replace(array('..', "\n", "\r"), array('', '', ''), $dir);
	$ret_val = false;
	if (is_dir($dir))
	{
		$d = @dir($dir);
		if($d)
		{
			while (false !== ($entry = $d->read()))
			{
				if($entry!='.' && $entry!='..')
				{
					$entry = $dir.'/'.$entry;
					if(is_dir($entry))
					{
						wl_rmdir($entry);
					}
					else
					{
						@unlink($entry);
					}
				}
			}
			$d->close();
			$ret_val = rmdir($dir);
		}
	}
	else
	{
		$ret_val = unlink($dir);
	}

	return $ret_val;
}

/**
 * 本地化语言项
 * @param string $key	语言项
 */

function L($key){
	return cc()->lang->get($key);
}

/**
 * 获取站点配置数据 
 */
function site_info($key=''){
	static $_site_configs = null;
	if(!$_site_configs){
		cc()->load->m('system/config',null,'');
		$_site_configs = cc()->configModel->get_configs('c_value');
	}
	if($key==='') return $_site_configs;
	if(!key_exists($key, $_site_configs)) return false;
	return $_site_configs[$key];
}



