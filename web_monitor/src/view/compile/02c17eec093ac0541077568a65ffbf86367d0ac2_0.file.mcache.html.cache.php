<?php
/* Smarty version 3.1.30, created on 2016-11-25 17:18:38
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583801ee5825a9_66085363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02c17eec093ac0541077568a65ffbf86367d0ac2' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html',
      1 => 1480065516,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_583801ee5825a9_66085363 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1606159123583801ee542230_21321565';
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>
<body>
<div class="wrap J_check_wrap">
	<div class="nav">
		<ul class="cc">
			<li class="current"><a href="#">缓存监控</a></li>
		</ul>
	</div>
	<div class="h_a">提示信息</div>
	<div class="mb10 prompt_text">
		<ol>
			<li>缓存数据的查看,以缓存key值为分类。</li>
			<li>每个key值分类下为相应的key值数据的队列，一般缓存取key值为队列第一个元素数据</li>
		</ol>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['cacheData']->value) {?>
	<div class="table_list">
		<table width="100%">
			<thead>
				<tr>
					<td width="18%">key值</td>
					<td>缓存数据表</td>
				</tr>
			</thead>
			<tbody id="J_tag_list">
			<tr>
				<td id="tree" class="ztree" style="width:260px; overflow:auto;"></td>
				<td id="cache">
					<table width="100%">
						<thead>
							<tr>
								<td width="6%">id</td>
								<td width="12%">缓存key</td>
								<td width="15%">添加时间</td>
								<td width="15%">更新时间</td>
								<td>缓存数据</td>
							</tr>
						</thead>
						<tbody id="J_tag_list">
						<tr>
							<td id="id"></td>
							<td id="key"></td>
							<td id="add_time"></td>
							<td id="up_time"></td>
							<td id="content"></td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php } else { ?>
		<div class="not_content_mini"><i></i>啊哦，没有数据！</div>
	<?php }?>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html>
<?php echo '<script'; ?>
 type="text/javascript" >
var zTree;
var demoIframe;

var setting = {
	view: {
		dblClickExpand: false,
		showLine: true,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				var id  = treeNode.id;
				var pid = treeNode.pid;
				var key = treeNode.key;
				var add_time = treeNode.add_time;
				var up_time = treeNode.up_time;
				var content = treeNode.cache;
				//var cache = $.fn.zTree.getZTreeObj("cache");
				$("#cache").find('#id').html(id);
				$("#cache").find('#key').html(key);
				$("#cache").find('#add_time').html(add_time);
				$("#cache").find('#up_time').html(up_time);
				$("#cache").find('#content').html(content);
				return true;
			}
		},
	}
};

var zNodes = <?php echo $_smarty_tpl->tpl_vars['cacheData']->value;?>
;

$(document).ready(function(){
	var t = $("#tree");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	demoIframe.bind("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	zTree.selectNode(zTree.getNodeByParam("id", 101));

});

function loadReady() {
	var bodyH = demoIframe.contents().find("body").get(0).scrollHeight,
	htmlH = demoIframe.contents().find("html").get(0).scrollHeight,
	maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
	h = demoIframe.height() >= maxH ? minH:maxH ;
	if (h < 530) h = 530;
	demoIframe.height(h);
}

<?php echo '</script'; ?>
>
<?php }
}
