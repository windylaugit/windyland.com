<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 16:32:13
         compiled from "E:\www\windyland\application\templates\admin\config\security.html" */ ?>
<?php /*%%SmartyHeaderCode:1395757415b2e241648-95443578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88188549dc385f6e33e23739782d6a33a440a109' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\config\\security.html',
      1 => 1463905038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1395757415b2e241648-95443578',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57415b2e247400_72851712',
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57415b2e247400_72851712')) {function content_57415b2e247400_72851712($_smarty_tpl) {?><div class="tabCon" id="j_config_cont_security">
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">允许访问后台的IP列表：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <textarea class="textarea" name="white_ips"><?php echo $_smarty_tpl->tpl_vars['config']->value['white_ips'];?>
</textarea>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">后台登录失败最大次数：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text"  name="max_failed_login"  class="input-text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['config']->value['max_failed_login'])===null||$tmp==='' ? 5 : $tmp);?>
">
        </div>
    </div>
</div><?php }} ?>
