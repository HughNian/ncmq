<?php
/* Smarty version 3.1.30, created on 2016-11-23 11:04:13
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/default.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5835072db2a0d7_64769229',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7423841d783c3c6dbcb328a08d543da7d8730638' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/default.html',
      1 => 1479558522,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_5835072db2a0d7_64769229 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '6315898555835072da4d164_68193220';
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>
<body>
	<div class="wrap">
		<div id="home_toptip"></div>
		<h2 class="h_a">系统信息</h2>
		<div class="home_info">
			<ul>
				<li><em>软件版本</em> <span><?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['system_version'];?>
</li>
				<li><em>PHP版本</em> <span><?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['php_version'];?>
</span></li>
				<li><em>服务器端信息</em> <span><?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['server_software'];?>
</span>
				</li>
				<li><em>最大上传限制</em> <span><?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['max_upload'];?>
</span></li>
				<li><em>最大执行时间</em> <span><?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['max_excute_time'];?>
</span>
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
<?php $_smarty_tpl->_subTemplateRender("file:../Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
