<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-23 20:07:28
         compiled from "E:\www\windyland\application\templates\admin\column\index.html" */ ?>
<?php /*%%SmartyHeaderCode:17165559c70ac4bbb51-17033003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e9e094f32bbb216e9820bff298d7e4d2544a40c' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\column\\index.html',
      1 => 1464004890,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17165559c70ac4bbb51-17033003',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_559c70ac511a73_01323610',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559c70ac511a73_01323610')) {function content_559c70ac511a73_01323610($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray">
    	<span class="l">
        	<a href="javascript:;" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="javascript:;" class="btn btn-primary radius" id="j_add_column"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a>
        </span>
   	</div>
    <div class="mt-20">
    	<div class="table-responsive" id="j_column_list">
            	
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
	require(['admin/page.column']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
