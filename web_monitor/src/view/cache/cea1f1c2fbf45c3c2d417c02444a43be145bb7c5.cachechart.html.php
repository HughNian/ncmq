<?php
/* Smarty version 3.1.30, created on 2016-11-28 10:03:03
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/cachechart.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583b90570c8646_34680771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ffbe1a85bea45e3fc342df22da39f382d58dcfa5' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/cachechart.html',
      1 => 1480298577,
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
function content_583b90570c8646_34680771 (Smarty_Internal_Template $_smarty_tpl) {
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
<link rel="stylesheet" href="/public/css/admin/ichart.css" type="text/css"/>
<style>
.show{display:block;}
.hide{display:none;}
</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap jj">
	<div class="nav">
		<ul class="cc">
			<li class="current"><a href="#">缓存统计</a></li>
		</ul>
	</div>
	<form class="J_ajaxForm" data-role="list" action="/Index/addcache" method="post" >
	<div class="h_a">缓存统计</div>
	<div class="table_full">
		<div id='canvasDiv'></div>
	</div>
</form>
</div>
<script src="/public/js/admin/pages/common/common.js?v20130702"></script>
</body>
<script type="text/javascript" src="/public/js/ichart.latest.min.js"></script>
<script type="text/javascript">
$(function(){
	var pv=[],ip=[],t;
	for(var i=0;i<7;i++){
		t = Math.floor(Math.random()*(30+((i%12)*5)))+10;
		pv.push(t);
		t = Math.floor(t*0.5);
		t = t-Math.floor((Math.random()*t)/2);
		ip.push(t);
	}
	console.log(pv);
	var data = [
				{
					name : 'PV',
					value:pv,
					color:'#0d8ecf',
					line_width:2
				},
				{
					name : 'IP',
					value:ip,
					color:'#ef7707',
					line_width:2
				}
			 ];
	 
	var labels = ["2012-08-01","2012-08-02","2012-08-03","2012-08-04","2012-08-05","2012-08-06","2012-08-07"];
	var line = new iChart.LineBasic2D({
		render : 'canvasDiv',
		data: data,
		align:'center',
		title : 'ncmq 缓存统计数量趋势',
		subtitle : 'ncmq 缓存系统',
		footnote : 'ncmq 缓存统计',
		width : 800,
		height : 400,
		tip:{
			enable:true,
			shadow:true
		},
		legend : {
			enable : true,
			row:1,//设置在一行上显示，与column配合使用
			column : 'max',
			valign:'top',
			sign:'bar',
			background_color:null,//设置透明背景
			offsetx:-80,//设置x轴偏移，满足位置需要
			border : true
		},
		crosshair:{
			enable:true,
			line_color:'#62bce9'
		},
		sub_option : {
			label:false,
			point_hollow : false
		},
		coordinate:{
			width:640,
			height:240,
			axis:{
				color:'#9f9f9f',
				width:[0,0,2,2]
			},
			grids:{
				vertical:{
					way:'share_alike',
					value:5
				}
			},
			scale:[{
				 position:'left',	
				 start_scale:0,
				 end_scale:100,
				 scale_space:10,
				 scale_size:2,
				 scale_color:'#9f9f9f'
			},{
				 position:'bottom',	
				 labels:labels
			}]
		}
	});

//开始画图
line.draw();
});
</script>
</html>

<?php }
}