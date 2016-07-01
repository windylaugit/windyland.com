<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-31 13:52:09
         compiled from "E:\www\windyland\application\templates\admin\content\article\post.html" */ ?>
<?php /*%%SmartyHeaderCode:20245744454fa5ebe0-36576607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac73278539cccd947100d005405a4d2e2ec726dc' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\content\\article\\post.html',
      1 => 1464673927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20245744454fa5ebe0-36576607',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5744454fdb26a4_49014586',
  'variables' => 
  array (
    'article' => 0,
    'lang' => 0,
    'columns' => 0,
    'c_id' => 0,
    'col' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5744454fdb26a4_49014586')) {function content_5744454fdb26a4_49014586($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<article class="page-container" data-aid="<?php echo $_smarty_tpl->tpl_vars['article']->value['aid'];?>
">
	<form class="form form-horizontal" id="j_form">
		<div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_c_id"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['c_name'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" name="c_id" id="field_c_id">
                    <?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_smarty_tpl->tpl_vars['c_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value) {
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['c_id']->value = $_smarty_tpl->tpl_vars['col']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['c_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['col']->value['selected'];?>
><?php echo $_smarty_tpl->tpl_vars['col']->value['text'];?>
</option>
                    <?php } ?>
                </select>
			</div>
		</div>
		
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_title"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['title'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="title" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
" id="field_title" placeholder="输入文章的标题" >
			</div>
		</div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_keywords"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['keywords'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="keywords" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['keywords'];?>
" id="field_keywords" placeholder="文章关键字,以空格分隔" >
			</div>
		</div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_author"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['author'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="author" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['author'];?>
" id="field_author" placeholder="文章作者" >
			</div>
		</div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['thumb_image'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	<div class="image-add-80" id="j_thumb_image_prev">
                	<?php if ($_smarty_tpl->tpl_vars['article']->value['thumb_image']&&$_smarty_tpl->tpl_vars['article']->value['thumb_image_url']) {?>
                    <img width="80" height="80" src="<?php echo $_smarty_tpl->tpl_vars['article']->value['thumb_image_url'];?>
" />
                    <?php }?>
                </div>
				<input type="hidden"  name="thumb_image" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['thumb_image'];?>
" id="j_thumb_image" placeholder="预览图" >
			</div>
		</div>
        
        
        <div class="row row-field cl">
            <label class="form-label col-xs-4 col-sm-2" for="field_description"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['description'];?>
：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea class="textarea" name="description" id="field_description" rows="2"><?php echo $_smarty_tpl->tpl_vars['article']->value['description'];?>
</textarea>
            </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" for="field_content"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['content'];?>
：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea class="" name="content" id="field_content" style="height:400px;width:100%;"><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</textarea>
            </div>
        </div>
        
        
        <div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="button" id="j_submit"><i class="Hui-iconfont">&#xe632;</i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value['save'];?>
</button>
				<button class="btn btn-default radius" type="button" id="j_cancel">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>


<?php echo '<script'; ?>
>
	require(['admin/content/article.post']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
