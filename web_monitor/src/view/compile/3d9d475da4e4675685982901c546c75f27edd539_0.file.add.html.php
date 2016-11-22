<?php
/* Smarty version 3.1.30, created on 2016-11-22 14:33:32
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5833e6bc0386a3_82711504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d9d475da4e4675685982901c546c75f27edd539' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/add.html',
      1 => 1479796406,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_5833e6bc0386a3_82711504 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
.show{display:block;}
.hide{display:none;})
</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap jj">
	<div class="nav">
		<ul class="cc">
			<li class="current"><a href="#">添加缓存</a></li>
		</ul>
	</div>
	<form class="J_ajaxForm" data-role="list" action="/Index/addcache" method="post" >
	<div class="h_a">添加缓存</div>
	<div class="table_full">
		<table width="100%">
			<col class="th"/>
			<col />
			<thead>
			<tr>
				<th>缓存名</th>
				<td><span class="must_red">*</span><input name="name" type="text" class="input length_3"></td>
			</tr>
			<tr>
				<th>缓存内容</th>
				<td><span class="must_red">*</span><textarea class="length_5" name="cache" style="height:150px"></textarea></td>
			</tr>
			<tr>
				<th>超时时间</th>
				<td><input name="overtime" type="text" class="input length_1" value="0"></td>
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
