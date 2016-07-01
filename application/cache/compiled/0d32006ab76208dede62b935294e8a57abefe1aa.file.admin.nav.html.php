<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 14:18:24
         compiled from "E:\www\windyland\application\templates\admin\_public\admin.nav.html" */ ?>
<?php /*%%SmartyHeaderCode:20448574140c7551894-65421589%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d32006ab76208dede62b935294e8a57abefe1aa' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\_public\\admin.nav.html',
      1 => 1463897903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20448574140c7551894-65421589',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_574140c76c4ae6_36612529',
  'variables' => 
  array (
    'admin_navs' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574140c76c4ae6_36612529')) {function content_574140c76c4ae6_36612529($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['admin_navs']->value) {?>
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['admin_navs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
&nbsp;<?php if (!$_smarty_tpl->tpl_vars['v']->value['is_last']) {?><span class="c-gray en">&gt;</span><?php }
} ?>
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<?php }?><?php }} ?>
