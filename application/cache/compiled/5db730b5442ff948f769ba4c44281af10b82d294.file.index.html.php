<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-25 19:53:28
         compiled from "E:\www\windyland\application\templates\admin\content\article\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1831355e1037d04b854-60094407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5db730b5442ff948f769ba4c44281af10b82d294' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\content\\article\\index.html',
      1 => 1464177200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1831355e1037d04b854-60094407',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55e1037d2204c0_53120182',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e1037d2204c0_53120182')) {function content_55e1037d2204c0_53120182($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray">
    	<span class="l">
        	<a href="javascript:;" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="javascript:;" class="btn btn-primary radius" id="j_add"><i class="Hui-iconfont">&#xe600;</i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value['pub_article'];?>
</a>
        </span>
   	</div>
    <div class="mt-20">
    	<div class="table-responsive" id="j_article_list">
            	
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
	require(['admin/content/article.index']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
