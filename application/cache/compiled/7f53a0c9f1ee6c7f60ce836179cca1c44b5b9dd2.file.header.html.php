<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-06 20:43:18
         compiled from "E:\www\windyland\application\templates\_public\header.html" */ ?>
<?php /*%%SmartyHeaderCode:10546574d98b3d50798-41446209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f53a0c9f1ee6c7f60ce836179cca1c44b5b9dd2' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\_public\\header.html',
      1 => 1465216994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10546574d98b3d50798-41446209',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_574d98b4248642_21958513',
  'variables' => 
  array (
    'base_url' => 0,
    'SEO' => 0,
    'WL_APPEND_RES' => 0,
    'res' => 0,
    'all_import_res' => 0,
    'site' => 0,
    'navs' => 0,
    'k' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574d98b4248642_21958513')) {function content_574d98b4248642_21958513($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><!DOCTYPE HTML>
<html lang="zh-CN" itemscope="itemscope" itemtype="http://schema.org/WebPage">
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
<!--
<?php echo smarty_function_res(array('file'=>'link:libs/bootstrap/3.2.0/css/bootstrap.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:libs/fontawesome/4.2.0/css/font-awesome.min.css'),$_smarty_tpl);?>

-->
<?php echo smarty_function_res(array('file'=>'link:h-ui/font/iconfont.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:css/main.base.css'),$_smarty_tpl);?>

<?php echo smarty_function_res(array('file'=>'link:css/main.css'),$_smarty_tpl);?>



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
<header class="page-header">
    <div class="wp cl">
        <span class="page-header-logo">
            <a href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['site']->value['base_url'])===null||$tmp==='' ? '/' : $tmp);?>
" title="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
</a>
        </span>
        <nav class="page-header-navs" role="navigation" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
        	<ul class="cl">
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                <li data-item-id="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" class="nav-item <?php if ($_smarty_tpl->tpl_vars['v']->value['active']) {?>nav-item-active<?php }?>">
                	<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['href'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</a>
                <?php } ?>
                </li>
            </ul>
        </nav>
    </div>
</header>

<?php }} ?>
