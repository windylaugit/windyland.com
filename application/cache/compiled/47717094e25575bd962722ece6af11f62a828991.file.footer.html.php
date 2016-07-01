<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-13 09:08:23
         compiled from "E:\www\windyland\application\templates\_public\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:30339574d98b42b9af2-71526215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47717094e25575bd962722ece6af11f62a828991' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\_public\\footer.html',
      1 => 1465780099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30339574d98b42b9af2-71526215',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_574d98b42d1208_86863791',
  'variables' => 
  array (
    'jlang_json' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574d98b42d1208_86863791')) {function content_574d98b42d1208_86863791($_smarty_tpl) {?><footer class="page-footer mt-30">
	<div class="wp cl">
    	<p class="footer-menu">
        	<a href="http://demo.mobantu.com/mode/joinus">加入我们</a>
			<a href="http://demo.mobantu.com/mode/contant">联系我们</a>
			<a href="http://demo.mobantu.com/mode/about">关于我们</a>
		</p>
        <p>版权信息，可以自定义&nbsp;&nbsp;Theme by <a href="http://www.mobantu.com" target="_blank">Windyland.com</a></p>
    
    </div>
</footer>

<!-- languages from php to javascript -->
<?php echo '<script'; ?>
>
	window.Lang = <?php echo $_smarty_tpl->tpl_vars['jlang_json']->value;?>
;
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
