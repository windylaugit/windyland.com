<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-22 17:12:39
         compiled from "E:\www\windyland\application\templates\admin\admin.index.html" */ ?>
<?php /*%%SmartyHeaderCode:160155599cbd411a341-28167526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23e8e294b96e49ab6c98b5de4e21c2add9ee211c' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\admin.index.html',
      1 => 1463908354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160155599cbd411a341-28167526',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5599cbd4160857_87253365',
  'variables' => 
  array (
    'lang' => 0,
    'sys_user' => 0,
    'menu' => 0,
    'k' => 0,
    'v' => 0,
    'sk' => 0,
    'sv' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5599cbd4160857_87253365')) {function content_5599cbd4160857_87253365($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'link:css/admin/index.css','append'=>1),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<header class="navbar-wrapper" id="j_header">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl">
        	<a class="logo navbar-logo f-l mr-10 hidden-xs" href="/admin/"><?php echo $_smarty_tpl->tpl_vars['lang']->value['admin_title'];?>
</a>
            <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/admin/">ADMIN</a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li><?php echo $_smarty_tpl->tpl_vars['sys_user']->value['pgroup_name'];?>
</li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo $_smarty_tpl->tpl_vars['sys_user']->value['user_name'];?>
 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="#">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="#">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover">
                    	<a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>

<aside class="Hui-aside" id="j_aside">
	<div class="menu_dropdown bk_2">
    	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <dl id="menu-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" mid="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
">
			<dt>
            	<i class="Hui-iconfont <?php echo $_smarty_tpl->tpl_vars['v']->value['icon'];?>
"></i>
                <a href="javascript:;" data-href="<?php echo $_smarty_tpl->tpl_vars['v']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</a>
                <?php if ($_smarty_tpl->tpl_vars['v']->value['subs']) {?><i class="Hui-iconfont Hui-iconfont-arrow2-bottom menu_dropdown-arrow"></i><?php }?>
            </dt>
			<dd>
				<ul>
                	<?php  $_smarty_tpl->tpl_vars['sv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sv']->_loop = false;
 $_smarty_tpl->tpl_vars['sk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value['subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sv']->key => $_smarty_tpl->tpl_vars['sv']->value) {
$_smarty_tpl->tpl_vars['sv']->_loop = true;
 $_smarty_tpl->tpl_vars['sk']->value = $_smarty_tpl->tpl_vars['sv']->key;
?>
					<li sid="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['sk']->value;?>
"><a href="javascript:;" data-href="<?php echo $_smarty_tpl->tpl_vars['sv']->value['href'];?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['sv']->value['text'];?>
"><?php echo $_smarty_tpl->tpl_vars['sv']->value['text'];?>
</a></li>
                    <?php } ?>
				</ul>
			</dd>
		</dl>	
        <?php } ?>
    </div>
</aside>

<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>

<section class="Hui-article-box" id="j_section">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp" id="j_section_navs">
		</div>
		<div class="Hui-tabNav-more btn-group">
        	<a id="j_section_nav_prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
            <a id="j_section_nav_next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
       	</div>
	</div>
	<div class="Hui-article section-conts" id="j_section_conts">
	</div>
</section>



<?php echo '<script'; ?>
>
	require(['admin/page.index']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
