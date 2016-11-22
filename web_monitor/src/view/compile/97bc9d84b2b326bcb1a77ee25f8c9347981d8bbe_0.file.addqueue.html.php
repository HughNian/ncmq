<?php
/* Smarty version 3.1.30, created on 2016-11-22 16:21:08
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/addqueue.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5833fff4060df0_63693484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97bc9d84b2b326bcb1a77ee25f8c9347981d8bbe' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/addqueue.html',
      1 => 1479802820,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_5833fff4060df0_63693484 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
.show{display:block;}
.hide{display:none;}
</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap jj">
	<div class="nav">
		<ul class="cc">
			<li class="current"><a href="#">添加队列</a></li>
		</ul>
	</div>
	<form class="J_ajaxForm" data-role="list" action="/Index/addqueue" method="post" >
	<div class="h_a">添加队列</div>
	<div class="table_full">
		<table width="100%">
			<col class="th"/>
			<col />
			<thead>
			<tr>
				<th>队列名</th>
				<td><span class="must_red">*</span><input name="name" type="text" class="input length_3"></td>
			</tr>
			<tr>
				<th>队列内容</th>
				<td><span class="must_red">*</span><textarea class="length_5" name="queue" style="height:150px"></textarea></td>
			</tr>
            </thead>
		</table>
	</div>
	<div class="btn_wrap_pd">
		<button type="submit" class="btn btn_submit">提交</button>
	</div>
</form>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html>
<?php }
}
