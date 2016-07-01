<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-18 16:21:21
         compiled from "E:\www\windyland\application\templates\content\article.content.html" */ ?>
<?php /*%%SmartyHeaderCode:6245756cc69a9aff6-17435382%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '421553efdc8c8e1c138e9f844c758a8f16f9fbbf' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\content\\article.content.html',
      1 => 1466238074,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6245756cc69a9aff6-17435382',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5756cc69e19a45_96482461',
  'variables' => 
  array (
    'cont' => 0,
    'breadCrumbs' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5756cc69e19a45_96482461')) {function content_5756cc69e19a45_96482461($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'link:css/content/common.css','append'=>1),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="page-container">
	<div class="wp cl mt-30">
        <div class="w-930 mr-20 l">
        	<section class="cont-main">
                <article data-id="<?php echo $_smarty_tpl->tpl_vars['cont']->value['aid'];?>
" class="" itemtype="http://schema.org/Article">
                	<header>
                    	<div class="cont-breadcrumbs">
                            <i class="Hui-iconfont-home2"></i>&nbsp;
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['breadCrumbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <?php if ($_smarty_tpl->tpl_vars['v']->value['isLast']) {?>
                                <span><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</span>
                                <?php } else { ?>
                                <a href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['v']->value['href'])===null||$tmp==='' ? 'javascript:;' : $tmp);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</a>&nbsp;&gt;&nbsp;
                                <?php }?>
                            <?php } ?>
                        </div>
                        <div class="cont-head cl">
                        	<div class="cont-title l w-800">
                            	<h1><?php echo $_smarty_tpl->tpl_vars['cont']->value['title'];?>
</h1>
                            </div>
                            <div class="cont-statistics">
                            	<span>阅读&nbsp;4658次</span>
                                <span>点赞&nbsp;123次</span>
                            </div>
                        </div>
                    </header>
                    <div class="cont-description">
                        <p><?php echo $_smarty_tpl->tpl_vars['cont']->value['description'];?>
</p>
                    </div>
                    
                    <div class="cont-cont f-16 mt-10">
                        <?php echo $_smarty_tpl->tpl_vars['cont']->value['content'];?>

                    </div>
                    
                </article>
            </section>
            
            <section class="cont-share">
            Here is the share
            </section>
            
            <?php if ($_smarty_tpl->tpl_vars['cont']->value['allow_comments']) {?>
            <section class="cont-comments mt-20"><?php echo $_smarty_tpl->getSubTemplate ("comment/content.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cont_id'=>$_smarty_tpl->tpl_vars['cont']->value['cont_id']), 0);?>
</section>
            <?php }?>
        </div>
        <aside class="w-250 l">
        	Here is the side
        </aside>
	</div>
</div>



<?php echo '<script'; ?>
>
	define('PAGEVAL',function(){
		return {
				useComment:'<?php if ($_smarty_tpl->tpl_vars['cont']->value['allow_comments']) {?>true<?php }?>'
			};
	});
	require(['js/content/article.view']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
