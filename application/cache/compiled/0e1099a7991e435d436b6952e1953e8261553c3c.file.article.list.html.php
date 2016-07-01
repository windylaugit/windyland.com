<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-07 21:29:36
         compiled from "E:\www\windyland\application\templates\content\article.list.html" */ ?>
<?php /*%%SmartyHeaderCode:159725756cc406cf5d4-60125787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e1099a7991e435d436b6952e1953e8261553c3c' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\content\\article.list.html',
      1 => 1465303558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159725756cc406cf5d4-60125787',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'breadCrumbs' => 0,
    'v' => 0,
    'list' => 0,
    'art' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5756cc41264db8_81171251',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5756cc41264db8_81171251')) {function content_5756cc41264db8_81171251($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'link:css/content/common.css','append'=>1),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="page-container">
	<div class="wp cl mt-30">
        <div class="w-930 mr-20 l">
        	<section class="list-header radius">
            	<div class="list-header-breadcrumbs">
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
                
                <div class="list-header-filters">
                	Here is the list filters
                </div>
            </section><!-- end of list-header -->
            
            <section class="list-cont mt-20">
            	<?php  $_smarty_tpl->tpl_vars['art'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['art']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['art']->key => $_smarty_tpl->tpl_vars['art']->value) {
$_smarty_tpl->tpl_vars['art']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['art']->key;
?>
                <article data-id="<?php echo $_smarty_tpl->tpl_vars['art']->value['aid'];?>
" class="list-item list-article<?php if ($_smarty_tpl->tpl_vars['art']->value['thumb_image_url']) {?> list-item-has-image<?php }?>" itemtype="http://schema.org/Article">
                	<?php if ($_smarty_tpl->tpl_vars['art']->value['thumb_image_url']) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['art']->value['url'];?>
" class="list-item-image">
                    	<img src="<?php echo $_smarty_tpl->tpl_vars['art']->value['thumb_image_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['art']->value['title'];?>
" />
                    </a>
                    <?php }?>
                    <header>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['art']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['art']->value['title'];?>
" target="_blank" itemprop="url" rel="bookmark"><?php echo $_smarty_tpl->tpl_vars['art']->value['title'];?>
</a>
                    </header>
                    <p class="list-item-desc"><?php echo $_smarty_tpl->tpl_vars['art']->value['description'];?>
</p>
                    <p class="list-item-meta">
                    	<time itemprop="datePublished"><?php echo $_smarty_tpl->tpl_vars['art']->value['up_time'];?>
</time>
                    </p>
                </article>
                <?php } ?>
                <div class="list-pager">
                <?php echo $_smarty_tpl->getSubTemplate ("pager.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('pager'=>$_smarty_tpl->tpl_vars['pager']->value), 0);?>

                </div>   
            </section>
            
        </div>
        <aside class="w-250 l">
        	Here is the side
        </aside>
	</div>
</div>



<?php echo '<script'; ?>
>
	//require(['admin/page.index']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
