<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-16 06:35:55
         compiled from "E:\www\windyland\application\templates\admin\database\backups.html" */ ?>
<?php /*%%SmartyHeaderCode:141655a7000ccf5274-92170570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77290a8a54e26282d6ed4ea63f59cce2eaa31b02' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\database\\backups.html',
      1 => 1437021315,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141655a7000ccf5274-92170570',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55a7000ce2dab9_45141402',
  'variables' => 
  array (
    'columns_json' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55a7000ce2dab9_45141402')) {function content_55a7000ce2dab9_45141402($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="page-header">
    	
    </div>
	<div class="row">
    	<div class="col-xs-12">
        	<div class="table-responsive" id="backup_list">
            	
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	define('PAGEVAL',function(){
		return {
				columns_json:'<?php echo $_smarty_tpl->tpl_vars['columns_json']->value;?>
'
			}
	});
	require(['admin/page-database-backups']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
