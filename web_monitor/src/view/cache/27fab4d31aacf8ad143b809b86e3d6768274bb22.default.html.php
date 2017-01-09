<?php
/* Smarty version 3.1.30, created on 2017-01-09 17:51:50
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/default.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58735d36701409_61812589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7423841d783c3c6dbcb328a08d543da7d8730638' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/default.html',
      1 => 1479558522,
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
function content_58735d36701409_61812589 (Smarty_Internal_Template $_smarty_tpl) {
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
</head>
<body>
	<div class="wrap">
		<div id="home_toptip"></div>
		<h2 class="h_a">系统信息</h2>
		<div class="home_info">
			<ul>
				<li><em>软件版本</em> <span>0.0.1</li>
				<li><em>PHP版本</em> <span>7.0.9</span></li>
				<li><em>服务器端信息</em> <span>Linux niansong-VirtualBox 3.13.0-32-generic #57-Ubuntu SMP Tue Jul 15 03:51:12 UTC 2014 i686</span>
				</li>
				<li><em>最大上传限制</em> <span>100M</span></li>
				<li><em>最大执行时间</em> <span>30 seconds</span>
				</li>
			</ul>
		</div>
		<h2 class="h_a">开发人员</h2>
		<div class="home_info" id="home_devteam">
			<ul>         
				<li>
				<em>版权所有</em>            
				<span>年嵩</span>         
				</li>
				<li>
				<em>产品研发</em>            
				<span>年嵩</span>         
				</li>
			</ul>
		</div>
	</div>
<script src="/public/js/admin/pages/common/common.js?v20130702"></script>
</body>
</html><?php }
}
