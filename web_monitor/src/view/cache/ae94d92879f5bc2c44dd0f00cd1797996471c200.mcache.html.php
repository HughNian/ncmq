<?php
/* Smarty version 3.1.30, created on 2016-11-23 16:42:26
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58355672d5d559_08871427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02c17eec093ac0541077568a65ffbf86367d0ac2' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html',
      1 => 1479785070,
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
function content_58355672d5d559_08871427 (Smarty_Internal_Template $_smarty_tpl) {
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
								<td width="8%">id</td>
								<td width="15%">缓存key</td>
								<td>缓存数据</td>
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

var zNodes = [{"id":1,"pId":0,"name":"haha","cache":""},{"id":"10","pId":1,"key":"haha","name":"[id:0|key:haha]","cache":"{\"id\":201,\"intervalDays\":null,\"depCityCode\":\"CAN\",\"depCityName\":\"\\u5e7f\\u5dde\",\"arrCityCode\":\"SIN\",\"arrCityName\":\"\\u65b0\\u52a0\\u5761\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/D4\\\/D4\\\/Cii-T1gRsHGIdwhAAAC-24x1Q6QAADycwOGUX0AAL7z947.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":191858,\"title\":\"\\u5e7f\\u5dde\\u51fa\\u53d1\\u5f80\\u8fd4\\u65b0\\u52a0\\u5761\\u673a\\u7968\",\"label\":\"\\u9c7c\\u5c3e\\u72ee\\uff0c\\u73af\\u7403\\u5f71\\u57ce\",\"journeyType\":2,\"priceLowest\":1095,\"priceDate\":\"2017-01-09\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"}\r\n"},{"id":"11","pId":1,"key":"haha","name":"[id:1|key:haha]","cache":"haha\r\n"},{"id":2,"pId":0,"name":"key1","cache":""},{"id":"20","pId":2,"key":"key1","name":"[id:0|key:key1]","cache":"cdgsdgsdgsdg\r\n"},{"id":"21","pId":2,"key":"key1","name":"[id:1|key:key1]","cache":"{\"id\":201,\"intervalDays\":null,\"depCityCode\":\"CAN\",\"depCityName\":\"\\u5e7f\\u5dde\",\"arrCityCode\":\"SIN\",\"arrCityName\":\"\\u65b0\\u52a0\\u5761\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/D4\\\/D4\\\/Cii-T1gRsHGIdwhAAAC-24x1Q6QAADycwOGUX0AAL7z947.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":191858,\"title\":\"\\u5e7f\\u5dde\\u51fa\\u53d1\\u5f80\\u8fd4\\u65b0\\u52a0\\u5761\\u673a\\u7968\",\"label\":\"\\u9c7c\\u5c3e\\u72ee\\uff0c\\u73af\\u7403\\u5f71\\u57ce\",\"journeyType\":2,\"priceLowest\":1095,\"priceDate\":\"2017-01-09\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"}\r\n"},{"id":3,"pId":0,"name":"key2","cache":""},{"id":"30","pId":3,"key":"key2","name":"[id:0|key:key2]","cache":"{\"success\":true,\"errorCode\":710000,\"msg\":\"OK\",\"data\":{\"groupid\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\",\"children\":[{\"id\":201,\"intervalDays\":null,\"depCityCode\":\"CAN\",\"depCityName\":\"\\u5e7f\\u5dde\",\"arrCityCode\":\"SIN\",\"arrCityName\":\"\\u65b0\\u52a0\\u5761\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/D4\\\/D4\\\/Cii-T1gRsHGIdwhAAAC-24x1Q6QAADycwOGUX0AAL7z947.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":191858,\"title\":\"\\u5e7f\\u5dde\\u51fa\\u53d1\\u5f80\\u8fd4\\u65b0\\u52a0\\u5761\\u673a\\u7968\",\"label\":\"\\u9c7c\\u5c3e\\u72ee\\uff0c\\u73af\\u7403\\u5f71\\u57ce\",\"journeyType\":2,\"priceLowest\":1095,\"priceDate\":\"2017-01-09\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":207,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"BKK\",\"arrCityName\":\"\\u66fc\\u8c37\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/D4\\\/D5\\\/Cii-TlgRsO-IMvQ9AACk0Z9Qw3MAADydAO8lZMAAKTp922.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":192343,\"title\":\"\\u4e0a\\u6d77\\u51fa\\u53d1\\u5f80\\u8fd4\\u66fc\\u8c37\\u673a\\u7968\",\"label\":\"\\u6cf0\\u56fd\\u83dc\\uff0c\\u4eba\\u5996\\uff0c\\u591c\\u751f\\u6d3b\",\"journeyType\":2,\"priceLowest\":1113,\"priceDate\":\"2017-01-10\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":237,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"OSA\",\"arrCityName\":\"\\u5927\\u962a\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/E3\\\/31\\\/Cii-TlgYdA-INTtSAAEUD6G9rOMAAEEoQPzwPwAARQn458.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":193476,\"title\":\"\\u4e0a\\u6d77\\u5f80\\u8fd4\\u5927\\u962a\\u673a\\u7968\",\"label\":\"\\u5173\\u897f\\uff0c\\u7f8e\\u98df\\u4e4b\\u90fd\\uff0c\\u836f\\u5986\",\"journeyType\":2,\"priceLowest\":925,\"priceDate\":\"2016-12-19\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":255,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"OKA\",\"arrCityName\":\"\\u51b2\\u7ef3\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/F6\\\/FD\\\/Cii-TlgiyRCINwPnAADZ24WXb4YAAER1AF2rooAANnz637.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":197627,\"title\":\"\\u4e0a\\u6d77\\u5f80\\u8fd4\\u51b2\\u7ef3\\u673a\\u7968\",\"label\":\"\\u4e1c\\u65b9\\u590f\\u5a01\\u5937\\uff0c\\u9cb8\\u9ca8\\uff0c\\u7409\\u7403\",\"journeyType\":2,\"priceLowest\":1333,\"priceDate\":\"2016-11-24\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":258,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"TYO\",\"arrCityName\":\"\\u4e1c\\u4eac\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/F9\\\/9C\\\/Cii-T1gkG4mISD3_AAFQXu7U618AAETuwKZ4MkAAVB2548.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":198295,\"title\":\"\\u4e0a\\u6d77\\u5f80\\u8fd4\\u4e1c\\u4eac\\u673a\\u7968\",\"label\":\"\\u6da9\\u8c37\\uff0c\\u94f6\\u5ea7\\uff0c\\u8fea\\u58eb\\u5c3c\\uff0c\\u79cb\\u53f6\\u539f\\uff0c\\u6d45\\u8349\\u5bfa\\uff0c\\u5bcc\\u58eb\\u5c71\",\"journeyType\":2,\"priceLowest\":1201,\"priceDate\":\"2017-02-11\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":269,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"MFM\",\"arrCityName\":\"\\u6fb3\\u95e8\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/10\\\/58\\\/Cii-Tlgv2i-IL9p0AADgelyAS_4AAEl7gKPr8kAAOCS156.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":202790,\"title\":\"\\u4e0a\\u6d77\\u5f80\\u8fd4\\u6fb3\\u95e8\\u673a\\u7968\",\"label\":\"\\u8d4c\\u573a\\uff0c\\u8336\\u9910\\u5385\\uff0c\\u5a01\\u5c3c\\u65af\\u4eba\\uff0c\\u8461\\u631e\\uff0c\\u591c\\u751f\\u6d3b\",\"journeyType\":2,\"priceLowest\":671,\"priceDate\":\"2017-03-01\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"},{\"id\":270,\"intervalDays\":null,\"depCityCode\":\"SHA\",\"depCityName\":\"\\u4e0a\\u6d77\",\"arrCityCode\":\"SYD\",\"arrCityName\":\"\\u6089\\u5c3c\",\"activityId\":29,\"coverUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/10\\\/C6\\\/Cii-T1gv_PqIFr4mAACiKxJSMnAAAEmcAFHCXEAAKJD060.jpg\",\"type\":1,\"productId\":\"\",\"lowPriceId\":192365,\"title\":\"\\u4e0a\\u6d77\\u5f80\\u8fd4\\u6089\\u5c3c\\u673a\\u7968\",\"label\":\"\\u6fb3\\u6d32\\uff0c\\u888b\\u9f20\\uff0c\\u6b4c\\u5267\\u9662\",\"journeyType\":2,\"priceLowest\":1006,\"priceDate\":\"2017-01-08\",\"groupKey\":1,\"groupName\":\"\\u56fd\\u9645\\u673a\\u7968\"}]}}\r\n"}];

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
