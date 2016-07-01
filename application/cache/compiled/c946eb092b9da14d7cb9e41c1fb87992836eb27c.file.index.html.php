<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-10 02:36:19
         compiled from "E:\www\windyland\application\templates\admin\contentType\index.html" */ ?>
<?php /*%%SmartyHeaderCode:18013559f1383209596-67368108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c946eb092b9da14d7cb9e41c1fb87992836eb27c' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\contentType\\index.html',
      1 => 1436488528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18013559f1383209596-67368108',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_559f13832671b5_10537629',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559f13832671b5_10537629')) {function content_559f13832671b5_10537629($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="page-header">
    	<button type="button" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['lang']->value['add'];?>
</button>
    </div>
	<div class="row">
    	<div class="col-xs-12">
        	<div class="table-responsive" id="ctype_list">
            	
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	require(['admin/page-contentType']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
