<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-24 09:17:49
         compiled from "E:\www\windyland\application\templates\admin\content\article\add.html" */ ?>
<?php /*%%SmartyHeaderCode:2646755e39f81eebdf2-95152984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '738bd4744138677803dad3cfaff28295b3a675ae' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\content\\article\\add.html',
      1 => 1464052667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2646755e39f81eebdf2-95152984',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55e39f8217a7e3_02187217',
  'variables' => 
  array (
    'lang' => 0,
    'columns' => 0,
    'col' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e39f8217a7e3_02187217')) {function content_55e39f8217a7e3_02187217($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<article class="page-container">
	<form class="form form-horizontal" id="j_form">
		<div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_c_id"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['c_name'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select class="select" name="c_id" id="field_c_id">
                    <?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value) {
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['col']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['col']->value['c_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['col']->value['c_name'];?>
</option>
                    <?php } ?>
                </select>
			</div>
		</div>
		
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_title"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['title'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="title" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['title'];?>
" id="field_title" placeholder="输入文章的标题" >
			</div>
		</div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_keywords"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['keywords'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="keywords" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['keywords'];?>
" id="field_keywords" placeholder="文章关键字,以空格分隔" >
			</div>
		</div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_author"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['author'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="author" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['author'];?>
" id="field_author" placeholder="文章作者" >
			</div>
		</div>
        
        <div class="row row-field cl">
            <label class="form-label col-xs-4 col-sm-2" for="field_description"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['description'];?>
：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea class="textarea" name="description" id="field_description" rows="2"></textarea>
            </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" for="field_content"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['content'];?>
：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea class="" name="content" id="field_content" style="height:400px;width:100%;"></textarea>
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

	require(['admin/page.contentArticle.add']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
