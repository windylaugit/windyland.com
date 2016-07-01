<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 16:42:44
         compiled from "E:\www\windyland\application\templates\admin\config\base.html" */ ?>
<?php /*%%SmartyHeaderCode:21263570f8c2c8739c0-09449777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a308b684d1ed422b614805560636771c47f34634' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\config\\base.html',
      1 => 1463906437,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21263570f8c2c8739c0-09449777',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_570f8c2cac9575_49709917',
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_570f8c2cac9575_49709917')) {function content_570f8c2cac9575_49709917($_smarty_tpl) {?><div class="tabCon" id="j_config_cont_base">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>网站名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_name" placeholder="网站的名称,控制在25个字、50个字节以内" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_name'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>网站标题：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_title" placeholder="网站的主标题，控制在25个字、50个字节以内" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_title'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关键词：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_keywords" placeholder="5个左右,8汉字以内,用英文,隔开" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_keywords'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>描述：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_description" placeholder="空制在80个汉字，160个字符以内" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_description'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>css、js、images路径配置：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="static_url" placeholder="默认为空，为相对路径" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['static_url'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>上传目录配置：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="upload_url" placeholder="默认为upload" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['upload_url'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>底部版权信息：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_copyright" placeholder="&copy; 2016 windyland.com" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_copyright'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">备案号：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" name="site_icp" placeholder="备案号" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['site_icp'];?>
" class="input-text">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">统计代码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <textarea name="tongji_code" class="textarea"><?php echo $_smarty_tpl->tpl_vars['config']->value['tongji_code'];?>
</textarea>
        </div>
    </div>
</div><?php }} ?>
