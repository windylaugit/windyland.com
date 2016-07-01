<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-06-13 09:14:30
         compiled from "E:\www\windyland\application\templates\content\common.comments.html" */ ?>
<?php /*%%SmartyHeaderCode:25679575d4f79ae2d99-63213881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8705309680742b6a1118280427f3d434b2fc3e3' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\content\\common.comments.html',
      1 => 1465780409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25679575d4f79ae2d99-63213881',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_575d4f79ae6c19_72470097',
  'variables' => 
  array (
    'cont_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575d4f79ae6c19_72470097')) {function content_575d4f79ae6c19_72470097($_smarty_tpl) {?><div class="comments-box">
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
