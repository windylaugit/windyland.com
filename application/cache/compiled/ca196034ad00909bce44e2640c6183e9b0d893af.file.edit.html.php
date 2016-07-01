<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-14 09:31:04
         compiled from "E:\www\windyland\application\templates\admin\column\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:119755cb36e5b59f44-00571260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca196034ad00909bce44e2640c6183e9b0d893af' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\column\\edit.html',
      1 => 1439515548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '119755cb36e5b59f44-00571260',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55cb36e5d944c7_27790124',
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
<?php if ($_valid && !is_callable('content_55cb36e5d944c7_27790124')) {function content_55cb36e5d944c7_27790124($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="main-content">
	<div class="page-header">
    	
    </div>
	<div class="row">
    	<div class="col-xs-12">
        	<form class="form-horizontal" id="editForm">
            		<div class="form-group">
                    	<label class="col-xs-2 control-label" for="field_c_name"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['c_name'];?>
</label>
                    	<div class="col-xs-5">
                        	<input type="text" class="form-control" name="c_name" id="field_c_name" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['c_name'];?>
" />
                        </div>
                        <div class="col-xs-3">
                        	<span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-xs-2 control-label" for="field_alias"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['alias'];?>
</label>
                    	<div class="col-xs-5">
                        	<input type="text" class="form-control" name="alias" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['alias'];?>
"/>
                        </div>
                        <div class="col-xs-3">
                        	<span class="help-block"></span>
                        </div>
					</div>
					<div class="form-group">
                    	<label class="col-xs-2 control-label" for="field_parent_id"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['parent_id'];?>
</label>
                    	<div class="col-xs-5">
                        	<select class="form-control" name="parent_id" id="field_parent_id">
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
                        </div>
                        <div class="col-xs-3">
                        	<span class="help-block"></span>
                        </div>
					</div>
					<div class="form-group">
                    	<label class="col-xs-2 control-label" for="field_sort_order"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['sort_order'];?>
</label>
                    	<div class="col-xs-5">
                        	<span class="col-xs-5 no-padding-left">
                        	<input type="text" class="form-control col-xs-1" name="sort_order" id="field_sort_order" value='<?php echo $_smarty_tpl->tpl_vars['col']->value['sort_order'];?>
'/>
                            </span>
                        </div>
                        <div class="col-xs-3">
                        	<span class="help-block"></span>
                        </div>
					</div>
                    <div class="form-group hide">
                    	<div class="col-xs-offset-2 col-xs-5">
                        	<button type="button" class="btn btn-default" id="submit"><?php echo $_smarty_tpl->tpl_vars['lang']->value['fields']['save'];?>
</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
	require(['admin/page.column.edit']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
