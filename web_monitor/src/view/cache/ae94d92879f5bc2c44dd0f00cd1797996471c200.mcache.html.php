<?php
/* Smarty version 3.1.30, created on 2016-11-25 15:33:33
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5837e94d9f3001_14639977',
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
function content_5837e94d9f3001_14639977 (Smarty_Internal_Template $_smarty_tpl) {
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

var zNodes = [{"id":1,"pId":0,"name":"key1","cache":""},{"id":"10","pId":1,"key":"key1","name":"[id:0|key:key1]","cache":"hahahahahgagaga"},{"id":"11","pId":1,"key":"key1","name":"[id:1|key:key1]","cache":"{\"success\":true,\"errorCode\":710000,\"msg\":\"OK\",\"data\":{\"result\":[{\"3307\":[{\"flightType\":\"2\",\"orgCityCode\":\"200\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityCode\":\"414\",\"dstCityName\":\"\\u53a6\\u95e8\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":1,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"685\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_414\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"}"},{"id":"12","pId":1,"key":"key1","name":"[id:2|key:key1]","cache":"{\"success\":true,\"errorCode\":710000,\"msg\":\"OK\",\"data\":{\"result\":[{\"3307\":[{\"flightType\":\"2\",\"orgCityCode\":\"200\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityCode\":\"414\",\"dstCityName\":\"\\u53a6\\u95e8\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":1,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"685\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_414\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"},{\"flightType\":\"2\",\"orgCityCode\":\"414\",\"orgCityName\":\"\\u53a6\\u95e8\",\"dstCityCode\":\"200\",\"dstCityName\":\"\\u5317\\u4eac\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":2,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"685\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_414_200\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"}]},{\"3312\":[{\"flightType\":\"2\",\"orgCityCode\":\"414\",\"orgCityName\":\"\\u53a6\\u95e8\",\"dstCityCode\":\"2802\",\"dstCityName\":\"\\u6210\\u90fd\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":1,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"650\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_414_2802\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"},{\"flightType\":\"2\",\"orgCityCode\":\"2802\",\"orgCityName\":\"\\u6210\\u90fd\",\"dstCityCode\":\"414\",\"dstCityName\":\"\\u53a6\\u95e8\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":2,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"650\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2802_414\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"}]},{\"3314\":[{\"price\":385,\"discount\":2.9,\"departureDate\":\"2016-11-25\",\"beginDate\":\"2016-11-25\",\"orgCityCode\":\"1602\",\"dstCityCode\":\"300\",\"orgCityName\":\"\\u5357\\u4eac\",\"dstCityName\":\"\\u91cd\\u5e86\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":9,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_1602_300\\\/?start=2016-11-25&type=1\"},{\"price\":295,\"discount\":2.4,\"departureDate\":\"2016-12-15\",\"beginDate\":\"2016-12-15\",\"orgCityCode\":\"1602\",\"dstCityCode\":\"705\",\"orgCityName\":\"\\u5357\\u4eac\",\"dstCityName\":\"\\u6842\\u6797\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":10,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_1602_705\\\/?start=2016-12-15&type=1\"},{\"price\":360,\"discount\":1.5,\"departureDate\":\"2016-11-24\",\"beginDate\":\"2016-11-24\",\"orgCityCode\":\"1602\",\"dstCityCode\":\"3312\",\"orgCityName\":\"\\u5357\\u4eac\",\"dstCityName\":\"\\u4e3d\\u6c5f\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":11,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_1602_3312\\\/?start=2016-11-24&type=1\"},{\"price\":375,\"discount\":3,\"departureDate\":\"2016-11-28\",\"beginDate\":\"2016-11-28\",\"orgCityCode\":\"1602\",\"dstCityCode\":\"2102\",\"orgCityName\":\"\\u5357\\u4eac\",\"dstCityName\":\"\\u547c\\u548c\\u6d69\\u7279\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":12,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_1602_2102\\\/?start=2016-11-28&type=1\"},{\"price\":1345,\"discount\":6.9,\"departureDate\":\"2016-11-25\",\"beginDate\":\"2016-11-25\",\"orgCityCode\":\"1602\",\"dstCityCode\":\"902\",\"orgCityName\":\"\\u5357\\u4eac\",\"dstCityName\":\"\\u6d77\\u53e3\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":13,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_1602_902\\\/?start=2016-11-25&type=1\"},{\"price\":2130,\"discount\":8.4,\"departureDate\":\"2016-11-25\",\"beginDate\":\"2016-11-25\",\"orgCityCode\":\"200\",\"dstCityCode\":\"906\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u4e09\\u4e9a\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":1,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_906\\\/?start=2016-11-25&type=1\"},{\"price\":335,\"discount\":1.7,\"departureDate\":\"2016-11-30\",\"beginDate\":\"2016-11-30\",\"orgCityCode\":\"200\",\"dstCityCode\":\"3402\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u676d\\u5dde\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":2,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_3402\\\/?start=2016-11-30&type=1\"},{\"price\":865,\"discount\":4.9,\"departureDate\":\"2016-11-24\",\"beginDate\":\"2016-11-24\",\"orgCityCode\":\"200\",\"dstCityCode\":\"414\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u53a6\\u95e8\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":3,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_414\\\/?start=2016-11-24&type=1\"},{\"price\":795,\"discount\":2.8,\"departureDate\":\"2016-11-29\",\"beginDate\":\"2016-11-29\",\"orgCityCode\":\"200\",\"dstCityCode\":\"3312\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u4e3d\\u6c5f\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":4,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_3312\\\/?start=2016-11-29&type=1\"},{\"price\":1430,\"discount\":6,\"departureDate\":\"2016-11-29\",\"beginDate\":\"2016-11-29\",\"orgCityCode\":\"200\",\"dstCityCode\":\"902\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u6d77\\u53e3\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":5,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_902\\\/?start=2016-11-29&type=1\"},{\"price\":655,\"discount\":2.5,\"departureDate\":\"2016-12-25\",\"beginDate\":\"2016-12-25\",\"orgCityCode\":\"200\",\"dstCityCode\":\"3102\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityName\":\"\\u4e4c\\u9c81\\u6728\\u9f50\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":7,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_3102\\\/?start=2016-12-25&type=1\"},{\"price\":400,\"discount\":2.8,\"departureDate\":\"2017-01-13\",\"beginDate\":\"2017-01-13\",\"orgCityCode\":\"2802\",\"dstCityCode\":\"602\",\"orgCityName\":\"\\u6210\\u90fd\",\"dstCityName\":\"\\u5e7f\\u5dde\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":14,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2802_602\\\/?start=2017-01-13&type=1\"},{\"price\":995,\"discount\":5.9,\"departureDate\":\"2017-01-02\",\"beginDate\":\"2017-01-02\",\"orgCityCode\":\"2802\",\"dstCityCode\":\"906\",\"orgCityName\":\"\\u6210\\u90fd\",\"dstCityName\":\"\\u4e09\\u4e9a\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":17,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2802_906\\\/?start=2017-01-02&type=1\"},{\"price\":215,\"discount\":1.7,\"departureDate\":\"2016-12-10\",\"beginDate\":\"2016-12-10\",\"orgCityCode\":\"300\",\"dstCityCode\":\"3312\",\"orgCityName\":\"\\u91cd\\u5e86\",\"dstCityName\":\"\\u4e3d\\u6c5f\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":19,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_300_3312\\\/?start=2016-12-10&type=1\"},{\"price\":385,\"discount\":2.9,\"departureDate\":\"2016-11-28\",\"beginDate\":\"2016-11-28\",\"orgCityCode\":\"300\",\"dstCityCode\":\"1602\",\"orgCityName\":\"\\u91cd\\u5e86\",\"dstCityName\":\"\\u5357\\u4eac\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":20,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_300_1602\\\/?start=2016-11-28&type=1\"},{\"price\":605,\"discount\":3.9,\"departureDate\":\"2016-12-05\",\"beginDate\":\"2016-12-05\",\"orgCityCode\":\"300\",\"dstCityCode\":\"906\",\"orgCityName\":\"\\u91cd\\u5e86\",\"dstCityName\":\"\\u4e09\\u4e9a\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":21,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_300_906\\\/?start=2016-12-05&type=1\"},{\"price\":195,\"discount\":1.4,\"departureDate\":\"2016-11-25\",\"beginDate\":\"2016-11-25\",\"orgCityCode\":\"300\",\"dstCityCode\":\"2702\",\"orgCityName\":\"\\u91cd\\u5e86\",\"dstCityName\":\"\\u897f\\u5b89\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":22,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_300_2702\\\/?start=2016-11-25&type=1\"},{\"price\":305,\"discount\":2.4,\"departureDate\":\"2016-11-30\",\"beginDate\":\"2016-11-30\",\"orgCityCode\":\"602\",\"dstCityCode\":\"300\",\"orgCityName\":\"\\u5e7f\\u5dde\",\"dstCityName\":\"\\u91cd\\u5e86\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":23,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_602_300\\\/?start=2016-11-30&type=1\"},{\"price\":285,\"discount\":2,\"departureDate\":\"2016-11-28\",\"beginDate\":\"2016-11-28\",\"orgCityCode\":\"602\",\"dstCityCode\":\"2802\",\"orgCityName\":\"\\u5e7f\\u5dde\",\"dstCityName\":\"\\u6210\\u90fd\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":24,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_602_2802\\\/?start=2016-11-28&type=1\"},{\"price\":345,\"discount\":2.9,\"departureDate\":\"2016-12-08\",\"beginDate\":\"2016-12-08\",\"orgCityCode\":\"602\",\"dstCityCode\":\"3402\",\"orgCityName\":\"\\u5e7f\\u5dde\",\"dstCityName\":\"\\u676d\\u5dde\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":26,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_602_3402\\\/?start=2016-12-08&type=1\"},{\"price\":690,\"discount\":3.4,\"departureDate\":\"2016-12-28\",\"beginDate\":\"2016-12-28\",\"orgCityCode\":\"602\",\"dstCityCode\":\"3312\",\"orgCityName\":\"\\u5e7f\\u5dde\",\"dstCityName\":\"\\u4e3d\\u6c5f\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":27,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_602_3312\\\/?start=2016-12-28&type=1\"},{\"price\":195,\"discount\":1.4,\"departureDate\":\"2016-11-28\",\"beginDate\":\"2016-11-28\",\"orgCityCode\":\"2702\",\"dstCityCode\":\"300\",\"orgCityName\":\"\\u897f\\u5b89\",\"dstCityName\":\"\\u91cd\\u5e86\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":28,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2702_300\\\/?start=2016-11-28&type=1\"},{\"price\":445,\"discount\":2.5,\"departureDate\":\"2016-12-11\",\"beginDate\":\"2016-12-11\",\"orgCityCode\":\"2702\",\"dstCityCode\":\"3306\",\"orgCityName\":\"\\u897f\\u5b89\",\"dstCityName\":\"\\u5927\\u7406\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":29,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2702_3306\\\/?start=2016-12-11&type=1\"},{\"price\":885,\"discount\":4.5,\"departureDate\":\"2016-12-03\",\"beginDate\":\"2016-12-03\",\"orgCityCode\":\"2702\",\"dstCityCode\":\"906\",\"orgCityName\":\"\\u897f\\u5b89\",\"dstCityName\":\"\\u4e09\\u4e9a\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":30,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2702_906\\\/?start=2016-12-03&type=1\"},{\"price\":185,\"discount\":1.5,\"departureDate\":\"2016-12-10\",\"beginDate\":\"2016-12-10\",\"orgCityCode\":\"2702\",\"dstCityCode\":\"3402\",\"orgCityName\":\"\\u897f\\u5b89\",\"dstCityName\":\"\\u676d\\u5dde\",\"flightType\":\"2\",\"flightSource\":\"1\",\"sortBy\":\"1\",\"key_id\":31,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\",\"image_url\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_2702_3402\\\/?start=2016-12-10&type=1\"}]}]}}"},{"id":2,"pId":0,"name":"key2","cache":""},{"id":"20","pId":2,"key":"key2","name":"[id:0|key:key2]","cache":"{\"success\":true,\"errorCode\":710000,\"msg\":\"OK\",\"data\":{\"result\":[{\"3307\":[{\"flightType\":\"2\",\"orgCityCode\":\"200\",\"orgCityName\":\"\\u5317\\u4eac\",\"dstCityCode\":\"414\",\"dstCityName\":\"\\u53a6\\u95e8\",\"select_time_type\":\"1\",\"beginDate\":\"2016-11-27\",\"flightSource\":\"2\",\"sortBy\":\"1\",\"key_id\":1,\"promotionBeginAt\":\"\",\"promotionEndAt\":\"\",\"tag1\":\"\\u9996\\u90fd\\u822a\\u7a7a \\u2014 \\u201c\\u9014\\u725b\\u53f7\\u201d\\u7279\\u60e0\",\"tag2\":\"\\u7acb\\u51cf\",\"image_url\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\",\"price\":\"685\",\"discount\":\"\",\"solutionId\":\"\",\"airCompanyCode\":\"\",\"jumpUrl\":\"http:\\\/\\\/www.tuniu.com\\\/flight\\\/city_200_414\\\/?start=2016-11-27&type=1&\",\"imageUrl\":\"http:\\\/\\\/m.tuniucdn.com\\\/fb2\\\/t1\\\/G2\\\/M00\\\/1B\\\/AE\\\/Cii-TFg0N22IK9WpAD1JSR_7jt4AAEsSQJCuX4APUlh27.jpeg\"}"},{"id":"21","pId":2,"key":"key2","name":"[id:1|key:key2]","cache":"hahahgagagagakey2"}];

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
