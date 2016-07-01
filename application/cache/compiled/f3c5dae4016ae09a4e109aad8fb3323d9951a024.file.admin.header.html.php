<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 13:16:55
         compiled from "E:\www\windyland\application\templates\admin\_public\admin.header.html" */ ?>
<?php /*%%SmartyHeaderCode:18915574140c7342202-07904873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3c5dae4016ae09a4e109aad8fb3323d9951a024' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\_public\\admin.header.html',
      1 => 1463738110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18915574140c7342202-07904873',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'SEO' => 0,
    'WL_APPEND_RES' => 0,
    'res' => 0,
    'all_import_res' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_574140c751ad81_78783245',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574140c751ad81_78783245')) {function content_574140c751ad81_78783245($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<base id="base_url" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
">
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<?php echo $_smarty_tpl->tpl_vars['SEO']->value['metas'];?>

<?php echo $_smarty_tpl->tpl_vars['SEO']->value['title'];?>


<!-- JavaScript resources -->
<!--[if lt IE 9]>
<?php echo smarty_function_res(array('file'=>'script:libs/html5.js'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'script:libs/respond.min.js'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'script:libs/PIE-2.0beta1/PIE_IE678.js'),$_smarty_tpl);?>

<![endif]-->
<?php echo smarty_function_res(array('file'=>'script:libs/require/require.js'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'script:libs/require/require.config.js'),$_smarty_tpl);?>



<!-- Stylesheet resources -->
<?php echo smarty_function_res(array('file'=>'link:h-ui/css/H-ui.min.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:h-ui/css/style.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:h-ui/skin/default/skin.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:h-ui/font/iconfont.css'),$_smarty_tpl);?>


<?php echo smarty_function_res(array('file'=>'link:css/admin/common.css'),$_smarty_tpl);?>


<?php if ($_smarty_tpl->tpl_vars['WL_APPEND_RES']->value) {?>
    <?php  $_smarty_tpl->tpl_vars['res'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['res']->_loop = false;
 $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['WL_APPEND_RES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['res']->key => $_smarty_tpl->tpl_vars['res']->value) {
$_smarty_tpl->tpl_vars['res']->_loop = true;
 $_smarty_tpl->tpl_vars['f']->value = $_smarty_tpl->tpl_vars['res']->key;
?>
		<?php echo $_smarty_tpl->tpl_vars['res']->value;?>
    
    <?php } ?>
<?php }?>
<!-- import resources -->
<?php echo $_smarty_tpl->tpl_vars['all_import_res']->value;?>

</head>
<body>


<?php }} ?>
