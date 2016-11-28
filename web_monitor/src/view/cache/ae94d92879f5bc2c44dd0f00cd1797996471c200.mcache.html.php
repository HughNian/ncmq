<?php
/* Smarty version 3.1.30, created on 2016-11-28 15:02:59
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583bd6a354edb3_53054251',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02c17eec093ac0541077568a65ffbf86367d0ac2' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html',
      1 => 1480065516,
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
function content_583bd6a354edb3_53054251 (Smarty_Internal_Template $_smarty_tpl) {
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

var zNodes = [{"id":1,"pId":0,"name":"key1","cache":""},{"id":"10","pId":1,"key":"key1","name":"[id:0|key:key1]","cache":"ajajajajgagaghaqq","add_time":"2016-11-28 11:16:23","up_time":"--"},{"id":"11","pId":1,"key":"key1","name":"[id:1|key:key1]","cache":"hahahahkekekeke","add_time":"2016-11-28 11:13:48","up_time":"--"},{"id":2,"pId":0,"name":"key2","cache":""},{"id":"20","pId":2,"key":"key2","name":"[id:0|key:key2]","cache":"\u5c06\u7ea2\u9ed1\u6811\u5185\u7684\u67d0\u4e00\u4e2a\u8282\u70b9\u5220\u9664\u3002\u9700\u8981\u6267\u884c\u7684\u64cd\u4f5c\u4f9d\u6b21\u662f\uff1a\u9996\u5148\uff0c\u5c06\u7ea2\u9ed1\u6811\u5f53\u4f5c\u4e00\u9897\u4e8c\u53c9\u67e5\u627e\u6811\uff0c\u5c06\u8be5\u8282\u70b9\u4ece\u4e8c\u53c9\u67e5\u627e\u6811\u4e2d\u5220\u9664\uff1b\u7136\u540e\uff0c\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u7b49\u4e00\u7cfb\u5217\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002\u8be6\u7ec6\u63cf\u8ff0\u5982\u4e0b\uff1a\r\n\r\n\u7b2c\u4e00\u6b65\uff1a\u5c06\u7ea2\u9ed1\u6811\u5f53\u4f5c\u4e00\u9897\u4e8c\u53c9\u67e5\u627e\u6811\uff0c\u5c06\u8282\u70b9\u5220\u9664\u3002\r\n       \u8fd9\u548c\"\u5220\u9664\u5e38\u89c4\u4e8c\u53c9\u67e5\u627e\u6811\u4e2d\u5220\u9664\u8282\u70b9\u7684\u65b9\u6cd5\u662f\u4e00\u6837\u7684\"\u3002\u52063\u79cd\u60c5\u51b5\uff1a\r\n       \u2460 \u88ab\u5220\u9664\u8282\u70b9\u6ca1\u6709\u513f\u5b50\uff0c\u5373\u4e3a\u53f6\u8282\u70b9\u3002\u90a3\u4e48\uff0c\u76f4\u63a5\u5c06\u8be5\u8282\u70b9\u5220\u9664\u5c31OK\u4e86\u3002\r\n       \u2461 \u88ab\u5220\u9664\u8282\u70b9\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\u3002\u90a3\u4e48\uff0c\u76f4\u63a5\u5220\u9664\u8be5\u8282\u70b9\uff0c\u5e76\u7528\u8be5\u8282\u70b9\u7684\u552f\u4e00\u5b50\u8282\u70b9\u9876\u66ff\u5b83\u7684\u4f4d\u7f6e\u3002\r\n       \u2462 \u88ab\u5220\u9664\u8282\u70b9\u6709\u4e24\u4e2a\u513f\u5b50\u3002\u90a3\u4e48\uff0c\u5148\u627e\u51fa\u5b83\u7684\u540e\u7ee7\u8282\u70b9\uff1b\u7136\u540e\u628a\u201c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u7684\u5185\u5bb9\u201d\u590d\u5236\u7ed9\u201c\u8be5\u8282\u70b9\u7684\u5185\u5bb9\u201d\uff1b\u4e4b\u540e\uff0c\u5220\u9664\u201c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u201d\u3002\u5728\u8fd9\u91cc\uff0c\u540e\u7ee7\u8282\u70b9\u76f8\u5f53\u4e8e\u66ff\u8eab\uff0c\u5728\u5c06\u540e\u7ee7\u8282\u70b9\u7684\u5185\u5bb9\u590d\u5236\u7ed9\"\u88ab\u5220\u9664\u8282\u70b9\"\u4e4b\u540e\uff0c\u518d\u5c06\u540e\u7ee7\u8282\u70b9\u5220\u9664\u3002\u8fd9\u6837\u5c31\u5de7\u5999\u7684\u5c06\u95ee\u9898\u8f6c\u6362\u4e3a\"\u5220\u9664\u540e\u7ee7\u8282\u70b9\"\u7684\u60c5\u51b5\u4e86\uff0c\u4e0b\u9762\u5c31\u8003\u8651\u540e\u7ee7\u8282\u70b9\u3002 \u5728\"\u88ab\u5220\u9664\u8282\u70b9\"\u6709\u4e24\u4e2a\u975e\u7a7a\u5b50\u8282\u70b9\u7684\u60c5\u51b5\u4e0b\uff0c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u4e0d\u53ef\u80fd\u662f\u53cc\u5b50\u975e\u7a7a\u3002\u65e2\u7136\"\u7684\u540e\u7ee7\u8282\u70b9\"\u4e0d\u53ef\u80fd\u53cc\u5b50\u90fd\u975e\u7a7a\uff0c\u5c31\u610f\u5473\u7740\"\u8be5\u8282\u70b9\u7684\u540e\u7ee7\u8282\u70b9\"\u8981\u4e48\u6ca1\u6709\u513f\u5b50\uff0c\u8981\u4e48\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\u3002\u82e5\u6ca1\u6709\u513f\u5b50\uff0c\u5219\u6309\"\u60c5\u51b5\u2460 \"\u8fdb\u884c\u5904\u7406\uff1b\u82e5\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\uff0c\u5219\u6309\"\u60c5\u51b5\u2461 \"\u8fdb\u884c\u5904\u7406\u3002\r\n\r\n\u7b2c\u4e8c\u6b65\uff1a\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u7b49\u4e00\u7cfb\u5217\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002\r\n       \u56e0\u4e3a\"\u7b2c\u4e00\u6b65\"\u4e2d\u5220\u9664\u8282\u70b9\u4e4b\u540e\uff0c\u53ef\u80fd\u4f1a\u8fdd\u80cc\u7ea2\u9ed1\u6811\u7684\u7279\u6027\u3002\u6240\u4ee5\u9700\u8981\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002","add_time":"2016-11-28 11:16:39","up_time":"--"}];

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
