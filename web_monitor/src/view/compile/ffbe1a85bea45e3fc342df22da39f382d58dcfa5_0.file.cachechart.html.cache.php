<?php
/* Smarty version 3.1.30, created on 2016-11-28 10:02:59
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/cachechart.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583b90533ad445_41888422',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ffbe1a85bea45e3fc342df22da39f382d58dcfa5' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/cachechart.html',
      1 => 1480298577,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_583b90533ad445_41888422 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '58145695583b905337f091_59614607';
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
<?php $_smarty_tpl->_subTemplateRender("file:../Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
<?php echo '<script'; ?>
 type="text/javascript" src="/public/js/ichart.latest.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>
</html>

<?php }
}
