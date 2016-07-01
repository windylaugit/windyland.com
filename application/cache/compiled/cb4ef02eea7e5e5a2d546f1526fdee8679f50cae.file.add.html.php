<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-23 22:00:43
         compiled from "E:\www\windyland\application\templates\admin\column\add.html" */ ?>
<?php /*%%SmartyHeaderCode:2191555c15defbf29a7-76223390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb4ef02eea7e5e5a2d546f1526fdee8679f50cae' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\column\\add.html',
      1 => 1464012038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2191555c15defbf29a7-76223390',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c15defc488b9_80198549',
  'variables' => 
  array (
    'lang' => 0,
    'col' => 0,
    'colOptions' => 0,
    'k' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c15defc488b9_80198549')) {function content_55c15defc488b9_80198549($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<article class="page-container">
	<form class="form form-horizontal" id="j_form">
		<div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_c_name"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['c_name'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="c_name" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['c_name'];?>
" id="field_c_name" placeholder="输入栏目的名称" >
			</div>
		</div>
		
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_alias"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['alias'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="alias" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['alias'];?>
" id="field_alias" placeholder="输入栏目的别称" >
			</div>
		</div>
        
        <div class="row row-field cl">
            <label class="form-label col-xs-4 col-sm-2" for="field_parent_id"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['parent_id'];?>
：</label>
            <div class="formControls col-xs-8 col-sm-9">
            	<span class="select-box">
                <select class="select" name="parent_id" id="field_parent_id">
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['colOptions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                    <option value=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['v']->value['selected'];?>
><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</option>
                    <?php } ?>
                </select>
                </span>
            </div>
        </div>
        
        <div class="row row-field cl">
			<label class="form-label col-xs-4 col-sm-2" for="field_sort_order"><span class="c-red">*</span><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['sort_order'];?>
：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"  name="sort_order" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['sort_order'];?>
" id="field_alias" placeholder="值越小越靠前,默认255" >
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
	require(['admin/page.column.add']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
