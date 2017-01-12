<?php
/* Smarty version 3.1.30, created on 2017-01-12 15:46:23
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mqueue.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5877344f8360c3_14583641',
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
function content_5877344f8360c3_14583641 (Smarty_Internal_Template $_smarty_tpl) {
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

var zNodes = [{"id":1,"pId":0,"name":"key0","cache":""},{"id":"10","cid":0,"pId":1,"key":"key0","name":"[id:0|key:key0]","queue":"6666666","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"11","cid":1,"pId":1,"key":"key0","name":"[id:1|key:key0]","queue":"55555555555555","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"12","cid":2,"pId":1,"key":"key0","name":"[id:2|key:key0]","queue":"3333333333333333","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"13","cid":3,"pId":1,"key":"key0","name":"[id:3|key:key0]","queue":"22222222222222222","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"14","cid":4,"pId":1,"key":"key0","name":"[id:4|key:key0]","queue":"11111111111111111111","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"15","cid":5,"pId":1,"key":"key0","name":"[id:5|key:key0]","queue":"11111111111111111111","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"16","cid":6,"pId":1,"key":"key0","name":"[id:6|key:key0]","queue":"22222222222222222","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"17","cid":7,"pId":1,"key":"key0","name":"[id:7|key:key0]","queue":"3333333333333333","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"18","cid":8,"pId":1,"key":"key0","name":"[id:8|key:key0]","queue":"55555555555555","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"19","cid":9,"pId":1,"key":"key0","name":"[id:9|key:key0]","queue":"6666666","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"110","cid":10,"pId":1,"key":"key0","name":"[id:10|key:key0]","queue":"11111111111111111111","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"111","cid":11,"pId":1,"key":"key0","name":"[id:11|key:key0]","queue":"22222222222222222","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"112","cid":12,"pId":1,"key":"key0","name":"[id:12|key:key0]","queue":"3333333333333333","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"113","cid":13,"pId":1,"key":"key0","name":"[id:13|key:key0]","queue":"55555555555555","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"114","cid":14,"pId":1,"key":"key0","name":"[id:14|key:key0]","queue":"6666666","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"115","cid":15,"pId":1,"key":"key0","name":"[id:15|key:key0]","queue":"11111111111111111111","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"116","cid":16,"pId":1,"key":"key0","name":"[id:16|key:key0]","queue":"22222222222222222","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"117","cid":17,"pId":1,"key":"key0","name":"[id:17|key:key0]","queue":"3333333333333333","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"118","cid":18,"pId":1,"key":"key0","name":"[id:18|key:key0]","queue":"55555555555555","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"119","cid":19,"pId":1,"key":"key0","name":"[id:19|key:key0]","queue":"6666666","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"120","cid":20,"pId":1,"key":"key0","name":"[id:20|key:key0]","queue":"enqueue key0\r\n22222222222222222enqueue key0\r\n3333333333333333enqueue key0\r\n55555555555555","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"121","cid":21,"pId":1,"key":"key0","name":"[id:21|key:key0]","queue":"6666666","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":2,"pId":0,"name":"key00","cache":""},{"id":"20","cid":0,"pId":2,"key":"key00","name":"[id:0|key:key00]","queue":"3333333333333333","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"21","cid":1,"pId":2,"key":"key00","name":"[id:1|key:key00]","queue":"22222222222222222","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"22","cid":2,"pId":2,"key":"key00","name":"[id:2|key:key00]","queue":"3333333333333333","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"23","cid":3,"pId":2,"key":"key00","name":"[id:3|key:key00]","queue":"22222222222222222","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"24","cid":4,"pId":2,"key":"key00","name":"[id:4|key:key00]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"25","cid":5,"pId":2,"key":"key00","name":"[id:5|key:key00]","queue":"3333333333333333","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"26","cid":6,"pId":2,"key":"key00","name":"[id:6|key:key00]","queue":"22222222222222222","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"27","cid":7,"pId":2,"key":"key00","name":"[id:7|key:key00]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"28","cid":8,"pId":2,"key":"key00","name":"[id:8|key:key00]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.ion.","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"29","cid":9,"pId":2,"key":"key00","name":"[id:9|key:key00]","queue":"22222222222222222","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"210","cid":10,"pId":2,"key":"key00","name":"[id:10|key:key00]","queue":"3333333333333333","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"211","cid":11,"pId":2,"key":"key00","name":"[id:11|key:key00]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"212","cid":12,"pId":2,"key":"key00","name":"[id:12|key:key00]","queue":"22222222222222222","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"213","cid":13,"pId":2,"key":"key00","name":"[id:13|key:key00]","queue":"3333333333333333","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"214","cid":14,"pId":2,"key":"key00","name":"[id:14|key:key00]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":3,"pId":0,"name":"key","cache":""},{"id":"30","cid":0,"pId":3,"key":"key","name":"[id:0|key:key]","queue":"55555555555555","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"31","cid":1,"pId":3,"key":"key","name":"[id:1|key:key]","queue":"3333333333333333","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"32","cid":2,"pId":3,"key":"key","name":"[id:2|key:key]","queue":"22222222222222222","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"33","cid":3,"pId":3,"key":"key","name":"[id:3|key:key]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"34","cid":4,"pId":3,"key":"key","name":"[id:4|key:key]","queue":"6666666","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"35","cid":5,"pId":3,"key":"key","name":"[id:5|key:key]","queue":"55555555555555","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"36","cid":6,"pId":3,"key":"key","name":"[id:6|key:key]","queue":"3333333333333333","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"37","cid":7,"pId":3,"key":"key","name":"[id:7|key:key]","queue":"22222222222222222","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"38","cid":8,"pId":3,"key":"key","name":"[id:8|key:key]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:34:54","up_time":"--"},{"id":"39","cid":9,"pId":3,"key":"key","name":"[id:9|key:key]","queue":"55555555555555","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"310","cid":10,"pId":3,"key":"key","name":"[id:10|key:key]","queue":"3333333333333333","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"311","cid":11,"pId":3,"key":"key","name":"[id:11|key:key]","queue":"22222222222222222","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"312","cid":12,"pId":3,"key":"key","name":"[id:12|key:key]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"313","cid":13,"pId":3,"key":"key","name":"[id:13|key:key]","queue":"6666666","add_time":"2017-01-12 15:34:22","up_time":"--"},{"id":"314","cid":14,"pId":3,"key":"key","name":"[id:14|key:key]","queue":"6666666","add_time":"2017-01-12 15:43:06","up_time":"--"},{"id":"315","cid":15,"pId":3,"key":"key","name":"[id:15|key:key]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"316","cid":16,"pId":3,"key":"key","name":"[id:16|key:key]","queue":"22222222222222222","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"317","cid":17,"pId":3,"key":"key","name":"[id:17|key:key]","queue":"3333333333333333","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"318","cid":18,"pId":3,"key":"key","name":"[id:18|key:key]","queue":"55555555555555","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"319","cid":19,"pId":3,"key":"key","name":"[id:19|key:key]","queue":"6666666","add_time":"2017-01-12 15:43:07","up_time":"--"},{"id":"320","cid":20,"pId":3,"key":"key","name":"[id:20|key:key]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\n\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\n\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"321","cid":21,"pId":3,"key":"key","name":"[id:21|key:key]","queue":"22222222222222222","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"322","cid":22,"pId":3,"key":"key","name":"[id:22|key:key]","queue":"3333333333333333","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"323","cid":23,"pId":3,"key":"key","name":"[id:23|key:key]","queue":"55555555555555","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":"324","cid":24,"pId":3,"key":"key","name":"[id:24|key:key]","queue":"6666666","add_time":"2017-01-12 15:43:08","up_time":"--"},{"id":4,"pId":0,"name":"queue0","cache":""},{"id":"40","cid":0,"pId":4,"key":"queue0","name":"[id:0|key:queue0]","queue":"This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.This means that a TCP RST was received and the connection is now closed. This occurs when a packet is sent from your end of the connection but the other end does not recognize the connection; it will send back a packet with the RST bit set in order to forcibly close the connection.\r\n\r\nThis can happen if the other side crashes and then comes back up or if it calls close() on the socket while there is data from you in transit, and is an indication to you that some of the data that you previously sent may not have been received.\r\n\r\nIt is up to you whether that is an error; if the information you were sending was only for the benefit of the remote client then it may not matter that any final data may have been lost. However you should close the socket and free up any other resources associated with the connection.","add_time":"2017-01-12 15:33:30","up_time":"--"}];

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
