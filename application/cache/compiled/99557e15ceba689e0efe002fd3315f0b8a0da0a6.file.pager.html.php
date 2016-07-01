<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-07 20:02:16
         compiled from "E:\www\windyland\application\templates\_public\pager.html" */ ?>
<?php /*%%SmartyHeaderCode:214585756b7a5e252e4-28066500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99557e15ceba689e0efe002fd3315f0b8a0da0a6' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\_public\\pager.html',
      1 => 1465300935,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214585756b7a5e252e4-28066500',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5756b7a60c3761_71699440',
  'variables' => 
  array (
    'pager' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5756b7a60c3761_71699440')) {function content_5756b7a60c3761_71699440($_smarty_tpl) {?><div class="pager">
	<ul>
    	<li class="pager-prev">
        	<?php if ($_smarty_tpl->tpl_vars['pager']->value['prev']) {?>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['pager']->value['prev']['url'];?>
">上一页</a>
            <?php } else { ?>
            <span>上一页</span>
            <?php }?>
       	</li>
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pager']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
        <li>
        	<?php if ($_smarty_tpl->tpl_vars['p']->value['is_ellipsis']) {?>
            <span> ... </span>
            <?php } elseif ($_smarty_tpl->tpl_vars['p']->value['current']) {?>
            <span class="pager-current"><?php echo $_smarty_tpl->tpl_vars['p']->value['page'];?>
</span>
            <?php } else { ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['p']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['page'];?>
</a>
            <?php }?>
        </li>
        <?php } ?>
        <li class="pager-next">
        	<?php if ($_smarty_tpl->tpl_vars['pager']->value['next']) {?>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['pager']->value['next']['url'];?>
">下一页</a>
            <?php } else { ?>
            <span>下一页</span>
            <?php }?>
       	</li>
        <li>
        	<span>共 <?php echo $_smarty_tpl->tpl_vars['pager']->value['pages'];?>
 页</span>
        </li>
    </ul>
</div><?php }} ?>
