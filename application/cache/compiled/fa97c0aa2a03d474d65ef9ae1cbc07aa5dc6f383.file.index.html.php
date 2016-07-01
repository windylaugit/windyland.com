<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 15:42:56
         compiled from "E:\www\windyland\application\templates\admin\config\index.html" */ ?>
<?php /*%%SmartyHeaderCode:11794574140c6d90a31-54147258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa97c0aa2a03d474d65ef9ae1cbc07aa5dc6f383' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\config\\index.html',
      1 => 1463901761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11794574140c6d90a31-54147258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_574140c719c338_16724095',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574140c719c338_16724095')) {function content_574140c719c338_16724095($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'link:css/admin/config.index.css','append'=>1),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="page-container">
	<form class="form form-horizontal" id="j_config_form">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl" id="j_config_tabs">
            	<span data-cont="base">基本设置</span>
                <span data-cont="security">安全设置</span>
                <span data-cont="email">邮件设置</span>
                <span data-cont="other">其他设置</span>
            </div>
			<?php echo $_smarty_tpl->getSubTemplate ("admin/config/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("admin/config/security.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("admin/config/email.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("admin/config/other.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="button" id="j_config_submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button class="btn btn-default radius" type="button" id="j_config_cancel">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>


<?php echo '<script'; ?>
>
	require(['admin/page.config']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
