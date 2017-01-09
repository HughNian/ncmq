<?php
/* Smarty version 3.1.30, created on 2017-01-09 11:23:25
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/addqueue.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5873022dd5f5f3_41451269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97bc9d84b2b326bcb1a77ee25f8c9347981d8bbe' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/addqueue.html',
      1 => 1479802820,
      2 => 'file',
    ),
    'f7ce84368a45b02340e74d6629d48f66e7e3e607' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Common/head.html',
      1 => 1479638562,
      2 => 'file',
    ),
    'de109df8f8be6e536e4261f9da061554c4279834' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Common/footer.html',
      1 => 1479636819,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 60,
),true)) {
function content_5873022dd5f5f3_41451269 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>ncmq监控系统</title>
<script>
//全局变量
var GV = {
	JS_ROOT : "/public/js/admin/",	//js目录
	JS_VERSION : "20130702",		//js版本号
	TOKEN : 'fef5c12b6aceb78b',	//token ajax全局
	REGION_CONFIG : {},
	SCHOOL_CONFIG : {},
	URL : {
		LOGIN : '/index',				//后台登录地址
		IMAGE_RES: '/public/images/admin',		//图片目录
	}
};
</script>
<link href="/public/css/admin/admin_style.css?v20130702" rel="stylesheet" />
<link href="/public/css/admin/zTreeStyle/zTreeStyle.css" rel="stylesheet" />
<script src="/public/js/admin/wind.js?v20130702"></script>
<script src="/public/js/admin/jquery.js?v20130702"></script>
<script type="text/javascript" src="/public/js/jquery.ztree.core-3.5.min.js"></script>
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
<script src="/public/js/admin/pages/common/common.js?v20130702"></script>
</body>
</html>
<?php }
}
