<?php
/* Smarty version 3.1.29, created on 2017-05-06 23:38:59
  from "E:\blog\App\Back\View\Category\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_590dee13cb7511_46747420',
  'file_dependency' => 
  array (
    '06f277ca7d57fe449254dfc6adc33ab1fb9b1baf' => 
    array (
      0 => 'E:\\blog\\App\\Back\\View\\Category\\index.html',
      1 => 1494084469,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/header.html' => 1,
  ),
),false)) {
function content_590dee13cb7511_46747420 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'E:/blog/Vendor/Smarty/plugins\\modifier.truncate.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<literal>
<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 添加分类的链接
			window.location.href = 'index.php?p=Back&c=Category&a=add';
		});
	});
<?php echo '</script'; ?>
>
</literal>
<div class="admin">
	<form method="post" action="index.php?p=Back&c=Category&a=delAll">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>分类列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="cate_id[]" value="全选" />
            <input type="button" id="btnAdd" class="button button-small border-green" value="添加分类" />
            <input type="submit" class="button button-small border-yellow" value="批量删除" onclick="return confirm('确认要批量删除当前分类吗？')"/>
            <input type="button" class="button button-small border-blue" value="回收站" />
        </div>
        <table class="table table-hover">
		     <tr>
                <th width="45">选择</th>
                <th width="120">所属类别</th>
                <th width="240">分类名称</th>
                <th width="*">分类描述</th>
                <th width="100">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['cateInfo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
            <tr>
                <td><input type="checkbox" name="cate_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_pid'];?>
</td>
                <td><?php echo preg_replace('!^!m',str_repeat('-',($_smarty_tpl->tpl_vars['row']->value['level']*5)),$_smarty_tpl->tpl_vars['row']->value['cate_name']);?>
</td>
                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['row']->value['cate_desc'],15);?>
</td>
                <td>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=Category&a=edit&cate_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
">修改</a> 
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=Category&a=del&cate_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
" onclick="return confirm('确认要删除当前分类吗？')">删除</a>
                </td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
        </table>
    </div>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
