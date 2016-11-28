<?php
/* Smarty version 3.1.30, created on 2016-11-28 10:58:18
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/syschart.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583b9d4ab1b584_94355321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45e660f59a922759d2acad98da2164cba7b207f1' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/syschart.html',
      1 => 1480301811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_583b9d4ab1b584_94355321 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1128604487583b9d4aadcee7_26728208';
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
			<li class="current"><a href="#">缓存队列系统统计</a></li>
		</ul>
	</div>
	<form class="J_ajaxForm" data-role="list" action="/Index/addcache" method="post" >
	<div class="h_a">缓存队列系统统计</div>
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
	console.log(<?php echo $_smarty_tpl->tpl_vars['cache']->value;?>
);
	var data = [
				{
					name : 'Cache',
					value: <?php echo $_smarty_tpl->tpl_vars['cache']->value;?>
,
					color:'#0d8ecf',
					line_width:2
				},
				{
					name : 'Queue',
					value: <?php echo $_smarty_tpl->tpl_vars['queue']->value;?>
,
					color: '#ef7707',
					line_width:2
				}
			 ];
	 
	var labels = <?php echo $_smarty_tpl->tpl_vars['week']->value;?>
;
	var line = new iChart.LineBasic2D({
		render : 'canvasDiv',
		data: data,
		align:'center',
		title : 'ncmq 缓存队列统计数量趋势',
		subtitle : 'ncmq 缓存队列一周统计',
		footnote : 'ncmq 缓存队列统计',
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
