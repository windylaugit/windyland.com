<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-17 09:00:31
         compiled from "E:\www\windyland\application\templates\comment\common.html" */ ?>
<?php /*%%SmartyHeaderCode:695057634bafc3c029-25913117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd8399fc9d7cf2a41eb60b29f80e9d445a3a1cb1' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\comment\\common.html',
      1 => 1466125039,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '695057634bafc3c029-25913117',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cont_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57634bafc68ef3_19060301',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57634bafc68ef3_19060301')) {function content_57634bafc68ef3_19060301($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'script:libs/require/require.js','append'=>1),$_smarty_tpl);?>

<div class="comments-box">
	<div class="comments-header">
    	<span class="comments-count" id="j_comt_count">0</span>条评论
    </div>
    <div class="comments-reply mt-10">
    	<div class="comments-reply-inner">
        	<div class="comments-reply-cont">
                <input type="hidden" name="cont_id" id="j_comt_cont_id" value="<?php echo $_smarty_tpl->tpl_vars['cont_id']->value;?>
" />
                <textarea class="" id="j_comt_cont" placeholder="留下您的精彩评论吧！"></textarea>
            </div>
            <div class="comments-replay-ctrl cl">
                <button type="button" class="btn btn-primary comments-reply-submit f-r">提交评论</button>
            </div>
        </div>
    </div>
    <div class="comments-list mt-10">
    	Loadding...
    </div>
</div><?php }} ?>
