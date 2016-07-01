<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 17:35:57
         compiled from "E:\www\windyland\application\templates\admin\dashboard\index.html" */ ?>
<?php /*%%SmartyHeaderCode:19153559c6bb62211c5-86812516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0a108d1b3c24598b296ae5e9a5f3b5f61afa4f7' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\dashboard\\index.html',
      1 => 1463909754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19153559c6bb62211c5-86812516',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_559c6bb626b559_70201041',
  'variables' => 
  array (
    'my_info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559c6bb626b559_70201041')) {function content_559c6bb626b559_70201041($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="page-container">
	<div class="welcome-infos">
    	<p class="f-20 text-success"><?php echo $_smarty_tpl->tpl_vars['my_info']->value['time_slot'];?>
好,<span class=""><?php echo $_smarty_tpl->tpl_vars['my_info']->value['user_name'];?>
</span>!</p>
        <p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
    </div>
	<div class="welcome-content-statistics">
    
    </div>
    <div class="welcome-server-infos">
    
    
    </div>
</div>


<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
