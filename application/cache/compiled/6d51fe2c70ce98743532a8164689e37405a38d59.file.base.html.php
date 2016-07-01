<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-14 20:11:48
         compiled from "E:\www\windyland\application\templates\admin\setting\base.html" */ ?>
<?php /*%%SmartyHeaderCode:22473570f6e933ac2f8-61554410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d51fe2c70ce98743532a8164689e37405a38d59' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\setting\\base.html',
      1 => 1460635905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22473570f6e933ac2f8-61554410',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_570f6e93652017_19821301',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_570f6e93652017_19821301')) {function content_570f6e93652017_19821301($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="page-header">
    </div>
	<div class="row">
    	<div class="col-xs-12">
        		<form class="form-horizontal" id="addForm">
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="field_site_name"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['site_name'];?>
</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="site_name" id="field_site_name" />
                            </div>
                            <div class="col-xs-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="field_site_title"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['site_title'];?>
</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="site_title" id="field_site_title" />
                            </div>
                            <div class="col-xs-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="field_site_keywords"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['site_keywords'];?>
</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="site_keywords" id="field_site_keywords" />
                            </div>
                            <div class="col-xs-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="field_site_description"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['site_description'];?>
</label>
                            <div class="col-xs-4">
                                <textarea class="form-control" name="site_description" id="field_site_description" rows="2"></textarea>
                            </div>
                            <div class="col-xs-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-xs-2 control-label" for="field_site_icp"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['site_keywords'];?>
</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="site_site_icp" id="field_site_icp" />
                            </div>
                            <div class="col-xs-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-5">
                                <button type="button" class="btn btn-default" id="submit"><?php echo $_smarty_tpl->tpl_vars['lang']->value['save2'];?>
</button>
                            </div>
                        </div>
                </form>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	require(['admin/page.setting']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
