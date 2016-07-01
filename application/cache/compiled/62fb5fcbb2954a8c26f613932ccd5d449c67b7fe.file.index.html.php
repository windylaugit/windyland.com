<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-26 21:41:44
         compiled from "E:\www\windyland\application\templates\admin\content\download\index.html" */ ?>
<?php /*%%SmartyHeaderCode:119515746fd1881b763-71844262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62fb5fcbb2954a8c26f613932ccd5d449c67b7fe' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\content\\download\\index.html',
      1 => 1464268381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '119515746fd1881b763-71844262',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5746fd19699319_06947014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5746fd19699319_06947014')) {function content_5746fd19699319_06947014($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray">
    	<span class="l">
        	<a href="javascript:;" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="javascript:;" class="btn btn-primary radius" id="j_add"><i class="Hui-iconfont">&#xe600;</i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value['pub_download'];?>
</a>
        </span>
   	</div>
    <div class="mt-20">
    	<div class="table-responsive" id="j_download_list">
            	
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
	require(['admin/content/download.index']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
