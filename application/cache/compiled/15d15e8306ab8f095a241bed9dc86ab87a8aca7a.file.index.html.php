<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-09-01 19:29:43
         compiled from "E:\www\windyland\application\templates\admin\contents_type\index.html" */ ?>
<?php /*%%SmartyHeaderCode:312455e58c2738b894-22477495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15d15e8306ab8f095a241bed9dc86ab87a8aca7a' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\contents_type\\index.html',
      1 => 1441106716,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '312455e58c2738b894-22477495',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55e58c273e1799_23141155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e58c273e1799_23141155')) {function content_55e58c273e1799_23141155($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="row">
    	<div class="col-xs-12">
        	<div class="table-responsive" id="ctype_list">
            	
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	require(['admin/page.contentsType']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
