<?php
/* Smarty version 3.1.30, created on 2016-11-22 14:09:06
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mqueue.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5833e10261ef46_48796075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf02fd9ef60582c2b235ef60367897b12fabbe88' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mqueue.html',
      1 => 1479794730,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Common/head.html' => 1,
    'file:../Common/footer.html' => 1,
  ),
),false)) {
function content_5833e10261ef46_48796075 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
<?php $_smarty_tpl->_subTemplateRender("file:../Common/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>
<body>
<div class="wrap J_check_wrap">
	<div class="nav">
		<ul class="cc">
			<li class="current"><a href="#">队列监控</a></li>
		</ul>
	</div>
	<div class="h_a">提示信息</div>
	<div class="mb10 prompt_text">
		<ol>
			<li>队列数据的查看,以队列key值为分类。</li>
			<li>key值下为相应队列</li>
		</ol>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['queueData']->value) {?>
	<div class="table_list">
		<table width="100%">
			<thead>
				<tr>
					<td width="18%">key值</td>
					<td>队列数据表</td>
				</tr>
			</thead>
			<tbody id="J_tag_list">
			<tr>
				<td id="tree" class="ztree" style="width:260px; overflow:auto;"></td>
				<td id="cache">
					<table width="100%">
						<thead>
							<tr>
								<td width="8%">id</td>
								<td width="15%">缓存key</td>
								<td>队列数据</td>
							</tr>
						</thead>
						<tbody id="J_tag_list">
						<tr>
							<td id="id"></td>
							<td id="key"></td>
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
<?php $_smarty_tpl->_subTemplateRender("file:../Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
				var content = treeNode.cache;
				//var cache = $.fn.zTree.getZTreeObj("cache");
				$("#cache").find('#id').html(id);
				$("#cache").find('#key').html(key);
				$("#cache").find('#content').html(content);
				return true;
			}
		},
	}
};

var zNodes = <?php echo $_smarty_tpl->tpl_vars['queueData']->value;?>
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
