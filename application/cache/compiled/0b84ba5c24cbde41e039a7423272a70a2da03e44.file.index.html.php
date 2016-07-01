<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-04 08:16:36
         compiled from "E:\www\windyland\application\templates\admin\database\index.html" */ ?>
<?php /*%%SmartyHeaderCode:441555a3b1294ff5d2-44362523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b84ba5c24cbde41e039a7423272a70a2da03e44' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\database\\index.html',
      1 => 1438647312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '441555a3b1294ff5d2-44362523',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55a3b12961c895_07552174',
  'variables' => 
  array (
    'lang' => 0,
    'columns_json' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55a3b12961c895_07552174')) {function content_55a3b12961c895_07552174($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="page-header">
    	<button type="button" class="btn btn-default" id="backupAll"><?php echo $_smarty_tpl->tpl_vars['lang']->value['backup_all'];?>
</button>
        <button type="button" class="btn btn-default" id="backupSelected"><?php echo $_smarty_tpl->tpl_vars['lang']->value['backup_selected'];?>
</button>
    </div>
	<div class="row">
    	<div class="col-xs-12">
        	<div class="table-responsive" id="table_list">
            	
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	define('PAGEVAL',function(){
		return {
				baseUrl:'/admin/database/',
				columns_json:'<?php echo $_smarty_tpl->tpl_vars['columns_json']->value;?>
'
			}
	});
	require(['admin/page.database']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
