<?php
/* Smarty version 3.1.29, created on 2017-05-18 15:52:23
  from "E:\blog\App\Home\View\Article\show.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_591d52b739f684_66711444',
  'file_dependency' => 
  array (
    '0edb7f017734f1a5934fae5a43ec9f78772e19f5' => 
    array (
      0 => 'E:\\blog\\App\\Home\\View\\Article\\show.html',
      1 => 1495093939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/header.html' => 1,
    'file:../Public/aside.html' => 1,
  ),
),false)) {
function content_591d52b739f684_66711444 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:/blog/Vendor/Smarty/plugins\\modifier.date_format.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>黑色Html5响应式个人博客模板——主题《如影随形》</title>
<meta name="keywords" content="个人博客模板,博客模板,响应式" />
<meta name="description" content="如影随形主题的个人博客模板，神秘、俏皮。" />
<link href="<?php echo @constant('CSS_DIR');?>
/base.css" rel="stylesheet">
<link href="<?php echo @constant('CSS_DIR');?>
/style.css" rel="stylesheet">
<link href="<?php echo @constant('CSS_DIR');?>
/media.css" rel="stylesheet">
<style type="text/css">
  .ds-replybox img {
    float:left;
    width:76px;
    height:76px;
  }
  textarea {
    box-shadow: none;
    color: #999;
    height: 54px;
    margin: 0;
    overflow: auto;
    padding: 10px;
    resize: none;
    width: 80%;
    margin-left:10px;
  }
  button {
    margin-top:10px;
    margin-left:85px;
    font-size: 14px;
    font-weight: bold;
    height: 32px;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    transition: all 0.15s linear 0s;
    width: 100px;
  }
  .otherlink dl {
    display:block;
    width:100%;
    height:65px;
    padding:20px 0;
    border-bottom:1px #DEDEDE solid;
  }
  .otherlink dt {
    float:left;
  }
  .otherlink h3 {
    color:#D23;
  }
  .otherlink h3,.otherlink p {
    line-height:22px;
    text-indent:10px;
  }
  .otherlink .msg {
     color:#333;
  }
  .otherlink .addtime {
     color:#999;
  }
  .logform input {
    width:140px;
    height:30px;
  }
</style>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/modernizr.js"><?php echo '</script'; ?>
>
<![endif]-->
</head>
<body>
<div class="ibody">
 <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <article>
    <h2 class="about_h">您现在的位置是：<a href="/">首页</a>
	<?php
$_from = $_smarty_tpl->tpl_vars['list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$__foreach_row_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
    ><a href="index.php?p=Home&c=Article&a=index$cate_id=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value;?>
</a>
	<?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
if ($__foreach_row_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_row_0_saved_key;
}
?>
    </h2>
    <div class="index_about">
      <h2 class="c_titile"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</h2>
      <p class="box_c"><span class="d_time">发布时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['addtime'],'%Y-%m-%d');?>
</span><span>编辑：<?php echo $_smarty_tpl->tpl_vars['row']->value['author'];?>
</span><span>浏览（<?php echo $_smarty_tpl->tpl_vars['row']->value['hits'];?>
）</span><span>评论览（14）</span></p>
      <ul class="infos">
        <?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>

      </ul>
      <div class="nextinfo">
        <p>上一篇：<a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo (($tmp = @$_smarty_tpl->tpl_vars['prev']->value['art_id'])===null||$tmp==='' ? $_GET['art_id'] : $tmp);?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['prev']->value['title'])===null||$tmp==='' ? '已经是第一篇了,没有了!' : $tmp);?>
</a></p>
        <p>下一篇：<a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo (($tmp = @$_smarty_tpl->tpl_vars['next']->value['art_id'])===null||$tmp==='' ? $_GET['art_id'] : $tmp);?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['next']->value['title'])===null||$tmp==='' ? '已经是最后一篇了,没有了!' : $tmp);?>
</a></p>
      </div>
      <div style="clear:both; height:10px;"></div>
      <div class="otherlink">
        <h2>评论列表</h2>
        <dl>
          <dt>
            <img width='50' height='50' src='./<?php echo @constant('IMAGES_DIR');?>
/s6.jpg'>
          </dt>
          <dd>
            <h3>
        剑圣
            </h3>
            <p class='msg'>我来了</p>
            <p class='addtime'>发布时间：2016-02-28 15:23:56</p>
          </dd>
        </dl>
            <dl>
          <dt>
            <img width='50' height='50' src='./<?php echo @constant('IMAGES_DIR');?>
/s7.jpg'>
          </dt>
          <dd>
            <h3>
        火影
            </h3>
            <p class='msg'>我也来了</p>
            <p class='addtime'>发布时间：2016-03-28 19:28:56</p>
          </dd>
        </dl>
      </div>
    </div>
    <div style="clear:both; height:10px;"></div>
      <div class="otherlink">
        <h2>发布评论</h2>
      </div>
      <form action="" method="post">
      <textarea placeholder="说点什么吧…" title="Ctrl+Enter快捷提交" name="content"></textarea>
    <button type="submit" class="ds-post-button">发布</button></form>
   <div class="page"><a href="/">1</a><a href="/">2</a><a href="/">3</a><a href="/">4</a><a href="/">5</a></div>
  </article>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/aside.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/silder.js"><?php echo '</script'; ?>
>
  <div class="clear"></div>
  <!-- 清除浮动 --> 
</div>
</body>
</html>
<?php }
}
