<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-27 10:41:46
         compiled from "E:\www\windyland\application\templates\admin\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:2608559621457e14f6-41836860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42eccd98ea96dfe4a7491f4d1e15ef12d9d50c02' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\footer.html',
      1 => 1461724903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2608559621457e14f6-41836860',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_559621457e5375_68272315',
  'variables' => 
  array (
    'jlang_json' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559621457e5375_68272315')) {function content_559621457e5375_68272315($_smarty_tpl) {?>

<!-- languages from php to javascript -->
<?php echo '<script'; ?>
>
	window.Lang = <?php echo $_smarty_tpl->tpl_vars['jlang_json']->value;?>
;
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
