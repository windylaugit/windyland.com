<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-18 16:44:28
         compiled from "E:\www\windyland\application\templates\comment\content.html" */ ?>
<?php /*%%SmartyHeaderCode:31065576500be697fd9-35789680%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7b5fe142a6430916ab41301ada878f73d31440c' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\comment\\content.html',
      1 => 1466239452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31065576500be697fd9-35789680',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_576500be7324e1_09422439',
  'variables' => 
  array (
    'cont_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576500be7324e1_09422439')) {function content_576500be7324e1_09422439($_smarty_tpl) {?><div class="comments-box" data-use-comment='1'>
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
            <div class="comments-reply-ctrl cl">
            	<div class="comments-reply-metas f-l">
                	<input type="text" id="j_comt_name" placeholder="您的昵称" value="" class="input-text comments-reply-name">
                </div>
                <button type="button" class="btn btn-primary comments-reply-submit f-r" id="j_comt_submit">提交评论</button>
            </div>
        </div>
    </div>
    <div class="comments-list mt-10" id="j_comt_list">
    	Loadding...
    </div>
</div><?php }} ?>
