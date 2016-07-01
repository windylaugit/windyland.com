<?php

function smarty_function_res($params, $smarty)
{
   $ret = $params['file'];
   $append = isset($params['append']) && $params['append'] ? !0:!1;
   $ret = preg_replace_callback('/^(script|link):(.*)$/', function($ms){
   		if($ms[1] == 'script'){
   			return '<script src="/s/'.$ms[2].'"></script>';
   		}else{
   			return '<link rel="stylesheet" href="/s/'.$ms[2].'" />';
   		}
   }, $ret);
   if($append){
   		$smarty->append('WL_APPEND_RES',$ret);
   		return '';
   }else{
	   	return $ret;
   }
}
