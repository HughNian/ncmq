<?php
/* Smarty version 3.1.30, created on 2016-11-28 15:03:40
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mqueue.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583bd6cce1da34_15416982',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf02fd9ef60582c2b235ef60367897b12fabbe88' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mqueue.html',
      1 => 1480316521,
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
function content_583bd6cce1da34_15416982 (Smarty_Internal_Template $_smarty_tpl) {
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
				<td id="queue">
					<table width="100%">
						<thead>
							<tr>
								<td width="6%">id</td>
								<td width="12%">缓存key</td>
								<td width="15%">添加时间</td>
								<td width="15%">更新时间</td>
								<td>队列数据</td>
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
	</div>
<script src="/public/js/admin/pages/common/common.js?v20130702"></script>
</body>
</html>
<script type="text/javascript" >
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
				var content = treeNode.queue;
				//var cache = $.fn.zTree.getZTreeObj("cache");
				$("#queue").find('#id').html(id);
				$("#queue").find('#key').html(key);
				$("#queue").find('#add_time').html(add_time);
				$("#queue").find('#up_time').html(up_time);
				$("#queue").find('#content').html(content);
				return true;
			}
		},
	}
};

var zNodes = [{"id":1,"pId":0,"name":"queue2","cache":""},{"id":"10","pId":1,"key":"queue2","name":"[id:0|key:queue2]","queue":"\u7f13\u51b2\u533a\u7684\u597d\u5904\uff0c\u5c31\u662f\u7a7a\u95f4\u6362\u65f6\u95f4\u548c\u534f\u8c03\u5feb\u6162\u7ebf\u7a0b\u3002\u7f13\u51b2\u533a\u53ef\u4ee5\u7528\u5f88\u591a\u8bbe\u8ba1\u6cd5\uff0c\u8fd9\u91cc\u8bf4\u4e00\u4e0b\u73af\u5f62\u7f13\u51b2\u533a\u7684\u51e0\u79cd\u8bbe\u8ba1\u65b9\u6848\uff0c\u53ef\u4ee5\u770b\u6210\u662f\u51e0\u79cd\u73af\u5f62\u7f13\u51b2\u533a\u7684\u6a21\u5f0f\u3002\u8bbe \u8ba1\u73af\u5f62\u7f13\u51b2\u533a\u6d89\u53ca\u5230\u51e0\u4e2a\u70b9\uff0c\u4e00\u662f\u8d85\u51fa\u7f13\u51b2\u533a\u5927\u5c0f\u7684\u7684\u7d22\u5f15\u5982\u4f55\u5904\u7406\uff0c\u4e8c\u662f\u5982\u4f55\u8868\u793a\u7f13\u51b2\u533a\u6ee1\u548c\u7f13\u51b2\u533a\u7a7a\uff0c\u4e09\u662f\u5982\u4f55\u5165\u961f\u3001\u51fa\u961f\uff0c\u56db\u662f\u7f13\u51b2\u533a\u4e2d\u6570\u636e\u957f\u5ea6\u5982\u4f55\u8ba1\u7b97\u3002","add_time":"2016-11-28 15:02:32","up_time":"--"},{"id":2,"pId":0,"name":"queue1","cache":""},{"id":"20","pId":2,"key":"queue1","name":"[id:0|key:queue1]","queue":"quququeueueueuqqq","add_time":"2016-11-28 11:13:56","up_time":"--"}];

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

</script>
<?php }
}
