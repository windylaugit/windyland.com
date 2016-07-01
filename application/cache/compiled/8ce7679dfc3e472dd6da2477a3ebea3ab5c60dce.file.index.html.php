<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-30 20:24:23
         compiled from "E:\www\windyland\application\templates\admin\files\index.html" */ ?>
<?php /*%%SmartyHeaderCode:125805747f2285658b7-42619334%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ce7679dfc3e472dd6da2477a3ebea3ab5c60dce' => 
    array (
      0 => 'E:\\www\\windyland\\application\\templates\\admin\\files\\index.html',
      1 => 1464610199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125805747f2285658b7-42619334',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5747f2288ccc06_43916762',
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5747f2288ccc06_43916762')) {function content_5747f2288ccc06_43916762($_smarty_tpl) {?><?php if (!is_callable('smarty_function_res')) include 'E:\\www\\windyland\\application\\core\\view\\smarty\\plugins\\function.res.php';
?><?php echo smarty_function_res(array('file'=>'link:css/admin/files.index.css','append'=>1),$_smarty_tpl);?>

<?php echo $_smarty_tpl->getSubTemplate ("admin.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if (!$_smarty_tpl->tpl_vars['config']->value['withoutNav']) {?>	<?php echo $_smarty_tpl->getSubTemplate ("admin.nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 <?php }?>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray">
    	<span class="l">
            <a href="javascript:;" class="btn btn-primary radius files-btn-upload" id="j_add_column">
            	<input type="file" name="upfile" class="files-btn-upload-ipt" id="j_upload_ipt">
                <span class="files-btn-upload-text" id="j_upload_text">
                	<i class="Hui-iconfont Hui-iconfont-add"></i>&nbsp;上传文件
                </span>
            </a>
        </span>
   	</div>
    <div class="mt-20">
    	<div class="files-list cl bg-1" id="j_files_list" style="height:200px;">
            	
        </div>
        <div class="files-panel bg-2" id="j_files_panel">
        	<div class="row cl">
            	<form id="j_info_form" class="form form-horizontal">
                <div class="files-panel-info col-xs-6">
                    <div class="row cl mt-15">
                    	<div class="col-xs-6">
                        	<div class="row cl">
                            	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文件名：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="j_info_file_name" name="original_name" placeholder="控制在25个字、50个字节以内" value="" class="input-text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row cl mt-15">
                        <div class="col-xs-6">
                        	<div class="row cl">
                                <label class="form-label col-xs-4 col-sm-3">文件大小：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="j_info_file_size" name="file_size" placeholder="" value="" class="input-text disabled" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                        	<div class="row cl">
                                <label class="form-label col-xs-4 col-sm-3">上传时间：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="j_info_add_time" name="add_time" placeholder="" value="" class="input-text disabled" readonly>
                                </div>
                        	</div>
                        </div>
                    </div>    
                </div>
                <div class="files-panel-btns col-xs-3">
                	<button class="btn btn-primary radius" type="button" id="j_info_save"><i class="Hui-iconfont Hui-iconfont-save"></i>&nbsp;保存修改</button>
                    <button class="btn btn-default radius" type="button" id="j_info_cancel"><i class="Hui-iconfont Hui-iconfont-close"></i>&nbsp;取消修改</button>
                </div>
                </form>
                <div class="files-panel-pager col-xs-3">
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
	define('PAGEVAL',function(){
		return {
				config: {
					fileTypes : '<?php echo $_smarty_tpl->tpl_vars['config']->value['fileTypes'];?>
',
					multiSelectAble : '<?php echo $_smarty_tpl->tpl_vars['config']->value['multiSelectAble'];?>
'?!0:!1	
				}
			}
	});
	require(['admin/files/index']);
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("admin.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
