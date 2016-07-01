<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-04 13:00:05
         compiled from "E:\www\windyland\application\templates\admin\database\rebuild.index.html" */ ?>
<?php /*%%SmartyHeaderCode:887155ac3e1e9abf23-36757669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8ffd4cb4bc1cb67956eb213d7b01a5bdab66e52' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\database\\rebuild.index.html',
      1 => 1438664055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '887155ac3e1e9abf23-36757669',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55ac3e1ead4d72_95720168',
  'variables' => 
  array (
    'columns_json' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ac3e1ead4d72_95720168')) {function content_55ac3e1ead4d72_95720168($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


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
	require(['admin/page.database.rebuild']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
