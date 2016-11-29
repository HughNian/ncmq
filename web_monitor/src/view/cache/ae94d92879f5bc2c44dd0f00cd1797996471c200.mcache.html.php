<?php
/* Smarty version 3.1.30, created on 2016-11-29 09:04:35
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/mcache.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583cd4237b2846_01553302',
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
function content_583cd4237b2846_01553302 (Smarty_Internal_Template $_smarty_tpl) {
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

var zNodes = [{"id":1,"pId":0,"name":"news-list","cache":""},{"id":"10","pId":1,"key":"news-list","name":"[id:0|key:news-list]","cache":"\u3010\u4e2d\u56fd\u5bb6\u7535\u4e0b\u4e61\u7f51\u8baf\u3011 \u6709\u201c\u72ec\u89d2\u517d\u201d\u4e4b\u79f0\u7684\u519c\u6751\u7535\u5546\u6c47\u901a\u8fbe\u8fd1\u671f\u518d\u83b7\u62db\u5546\u94f6\u884c3\u4ebf\u5143\u76f4\u63a5\u6295\u8d44\u3002\u4ece2015\u5e746\u670826\u65e5\u81f32016\u5e746\u670827\u65e5\u6574\u6574\u4e00\u5e74\u65f6\u95f4\uff0c\u8be5\u516c\u53f8\u5148\u540e\u83b7\u5f97\u5305\u62ec\u6cbf\u6d77\u8d44\u672c\u3001\u534e\u590f\u4eba\u5bff\u3001\u534e\u665f\u8d44\u672c\u3001\u65b0\u5929\u57df\u53ca\u6c5f\u82cf\u7701\u9ad8\u6295\u5728\u5185\u7684\u591a\u5bb6\u56fd\u5185\u77e5\u540d\u673a\u6784\u768413\u4ebf\u4eba\u6c11\u5e01\u6295\u8d44\u3002\u5728\u8d44\u672c\u5e02\u573a\u5927\u73af\u5883\u5e76\u4e0d\u597d\u7684\u60c5\u51b5\u4e0b\uff0c\u6c47\u901a\u8fbe\u9760\u4ec0\u4e48\u80fd\u591f\u83b7\u5f97\u8d44\u672c\u5927\u9cc4\u7684\u5982\u6b64\u9752\u7750\uff1f","add_time":"2016-11-28 17:06:06","up_time":"--"},{"id":2,"pId":0,"name":"key6","cache":""},{"id":"20","pId":2,"key":"key6","name":"[id:0|key:key6]","cache":"6666666666666666\r\n\u8003\u8651\u6570\u636e\u5e93\u5b58\u53d6\u4f8b\u7a0b\u5e93\uff0c\u5982\u679c\u6570\u636e\u5e93\u4e2d\u6240\u6709\u51fd\u6570\u90fd\u4ee5\u4e00\u81f4\u7684\u65b9\u6cd5\u5904\u7406\u8bb0\u5f55\u9501\uff0c\u5219\u79f0\u4f7f\u7528\u8fd9\u4e9b\u51fd\u6570\u5b58\u53d6\u6570\u636e\u5e93\u7684\u6240\u6709\u8fdb\u7a0b\u96c6\u4e3a\u201c\u5408\u4f5c\u8fdb\u7a0b\u201d(cooperating process)\u3002\u5982\u679c\u8fd9\u4e9b\u51fd\u6570\u662f\u60df\u4e00\u7684\u7528\u6765\u5b58\u53d6\u6570\u636e\u5e93\u7684\u51fd\u6570\uff0c\u90a3\u4e48\u4ed6\u4eec\u4f7f\u7528\u5efa\u8bae\u6027\u9501\u662f\u53ef\u884c\u7684\u3002\u4f46\u662f\uff0c\u5982\u4e0a\u9762\u7a0b\u5e8f\u6240\u770b\u5230\u7684\uff0c\u540c\u6837\u7684\u60c5\u51b5\uff0c\u5efa\u8bae\u6027\u9501\u4e5f\u4e0d\u80fd\u963b\u6b62\u5bf9\u6570\u636e\u5e93\u6587\u4ef6\u6709\u5199\u8bb8\u53ef\u6743\u9650\u7684\u4efb\u4f55\u5176\u4ed6\u8fdb\u7a0b\u5199\u6570\u636e\u5e93\u6587\u4ef6\uff01\u4e0d\u4f7f\u7528\u534f\u540c\u4e00\u81f4\u7684\u65b9\u6cd5( \u6570\u636e\u5e93\u5b58\u53d6\u4f8b\u7a0b\u5e93 )\u6765\u5b58\u53d6\u6570\u636e\u5e93\u7684\u8fdb\u7a0b\u662f\u4e00\u4e2a\u975e\u5408\u4f5c\u8fdb\u7a0b\u3002\r\n\r\n\u5728\u5f3a\u5236\u6027\u9501\u673a\u5236\u4e2d\uff0c\u5185\u6838\u5bf9\u6bcf\u4e00\u4e2a open\u3001read\u3001\u548c write \u90fd\u8981\u68c0\u67e5\u8c03\u7528\u8fdb\u7a0b\u5bf9\u6b63\u5728\u5b58\u53d6\u7684\u6587\u4ef6\u662f\u5426\u8fdd\u80cc\u4e86\u67d0\u4e00\u628a\u9501\u7684\u4f5c\u7528\u3002\u4e00\u822c\u60c5\u51b5\u4e0b\uff0c\u5185\u6838\u548c\u7cfb\u7edf\u90fd\u4e0d\u4f7f\u7528\u5efa\u8bae\u6027\u9501\u3002\u91c7\u7528\u5f3a\u5236\u6027\u9501\u5bf9\u6027\u80fd\u7684\u5f71\u54cd\u5f88\u5927\uff0c\u6bcf\u6b21\u8bfb\u5199\u64cd\u4f5c\u90fd\u8981\u5fc5\u987b\u68c0\u67e5\u662f\u5426\u6709\u9501\u5b58\u5728\u3002\r\n","add_time":"2016-11-29 08:50:55","up_time":"--"},{"id":3,"pId":0,"name":"key66","cache":""},{"id":"30","pId":3,"key":"key66","name":"[id:0|key:key66]","cache":"gdgdgdsgdg\r\n1\u3001\u73af\u5f62\u7f13\u51b2\u533a\r\n\r\n\u7f13\u51b2\u533a\u7684\u597d\u5904\uff0c\u5c31\u662f\u7a7a\u95f4\u6362\u65f6\u95f4\u548c\u534f\u8c03\u5feb\u6162\u7ebf\u7a0b\u3002\u7f13\u51b2\u533a\u53ef\u4ee5\u7528\u5f88\u591a\u8bbe\u8ba1\u6cd5\uff0c\u8fd9\u91cc\u8bf4\u4e00\u4e0b\u73af\u5f62\u7f13\u51b2\u533a\u7684\u51e0\u79cd\u8bbe\u8ba1\u65b9\u6848\uff0c\u53ef\u4ee5\u770b\u6210\u662f\u51e0\u79cd\u73af\u5f62\u7f13\u51b2\u533a\u7684\u6a21\u5f0f\u3002\u8bbe \u8ba1\u73af\u5f62\u7f13\u51b2\u533a\u6d89\u53ca\u5230\u51e0\u4e2a\u70b9\uff0c\u4e00\u662f\u8d85\u51fa\u7f13\u51b2\u533a\u5927\u5c0f\u7684\u7684\u7d22\u5f15\u5982\u4f55\u5904\u7406\uff0c\u4e8c\u662f\u5982\u4f55\u8868\u793a\u7f13\u51b2\u533a\u6ee1\u548c\u7f13\u51b2\u533a\u7a7a\uff0c\u4e09\u662f\u5982\u4f55\u5165\u961f\u3001\u51fa\u961f\uff0c\u56db\u662f\u7f13\u51b2\u533a\u4e2d\u6570\u636e\u957f\u5ea6\u5982\u4f55\u8ba1\u7b97\u3002\r\n\r\nps.\u89c4\u5b9a\u4ee5\u4e0b\u6240\u6709\u65b9\u6848\uff0c\u5728\u7f13\u51b2\u533a\u6ee1\u65f6\u4e0d\u53ef\u518d\u5199\u5165\u6570\u636e\uff0c\u7f13\u51b2\u533a\u7a7a\u65f6\u4e0d\u80fd\u8bfb\u6570\u636e\r\n\r\n1.1\u3001\u5e38\u89c4\u6570\u7ec4\u73af\u5f62\u7f13\u51b2\u533a\r\n \u8bbe\u7f13\u51b2\u533a\u5927\u5c0f\u4e3aN\uff0c\u961f\u5934out\uff0c\u961f\u5c3ein\uff0cout\u3001in\u5747\u662f\u4e0b\u6807\u8868\u793a:\r\n\r\n\u521d\u59cb\u65f6\uff0cin=out=0\r\n\u961f\u5934\u961f\u5c3e\u7684\u66f4\u65b0\u7528\u53d6\u6a21\u64cd\u4f5c\uff0cout=(out+1)%N\uff0cin=(in+1)%N\r\nout==in\u8868\u793a\u7f13\u51b2\u533a\u7a7a\uff0c(in+1)%N==out\u8868\u793a\u7f13\u51b2\u533a\u6ee1\r\n\u5165\u961fque[in]=value;in=(in+1)%N;\r\n\u51fa\u961fret =que[out];out=(out+1)%N;\r\n\u6570\u636e\u957f\u5ea6 len =( in - out + N) % N ","add_time":"2016-11-29 09:04:30","up_time":"--"},{"id":"31","pId":3,"key":"key66","name":"[id:1|key:key66]","cache":"6666666niankanlgjlasdgsdagkjgsg","add_time":"2016-11-29 09:04:08","up_time":"--"},{"id":4,"pId":0,"name":"fund-list","cache":""},{"id":"40","pId":4,"key":"fund-list","name":"[id:0|key:fund-list]","cache":"S(\"fund-list\", $list, 600);","add_time":"2016-11-28 17:05:23","up_time":"--"},{"id":5,"pId":0,"name":"key1","cache":""},{"id":"50","pId":5,"key":"key1","name":"[id:0|key:key1]","cache":"hahahahkekekeke","add_time":"2016-11-28 11:13:48","up_time":"--"},{"id":"51","pId":5,"key":"key1","name":"[id:1|key:key1]","cache":"ajajajajgagaghaqq","add_time":"2016-11-28 11:16:23","up_time":"--"},{"id":6,"pId":0,"name":"key2","cache":""},{"id":"60","pId":6,"key":"key2","name":"[id:0|key:key2]","cache":"\u5c06\u7ea2\u9ed1\u6811\u5185\u7684\u67d0\u4e00\u4e2a\u8282\u70b9\u5220\u9664\u3002\u9700\u8981\u6267\u884c\u7684\u64cd\u4f5c\u4f9d\u6b21\u662f\uff1a\u9996\u5148\uff0c\u5c06\u7ea2\u9ed1\u6811\u5f53\u4f5c\u4e00\u9897\u4e8c\u53c9\u67e5\u627e\u6811\uff0c\u5c06\u8be5\u8282\u70b9\u4ece\u4e8c\u53c9\u67e5\u627e\u6811\u4e2d\u5220\u9664\uff1b\u7136\u540e\uff0c\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u7b49\u4e00\u7cfb\u5217\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002\u8be6\u7ec6\u63cf\u8ff0\u5982\u4e0b\uff1a\r\n\r\n\u7b2c\u4e00\u6b65\uff1a\u5c06\u7ea2\u9ed1\u6811\u5f53\u4f5c\u4e00\u9897\u4e8c\u53c9\u67e5\u627e\u6811\uff0c\u5c06\u8282\u70b9\u5220\u9664\u3002\r\n       \u8fd9\u548c\"\u5220\u9664\u5e38\u89c4\u4e8c\u53c9\u67e5\u627e\u6811\u4e2d\u5220\u9664\u8282\u70b9\u7684\u65b9\u6cd5\u662f\u4e00\u6837\u7684\"\u3002\u52063\u79cd\u60c5\u51b5\uff1a\r\n       \u2460 \u88ab\u5220\u9664\u8282\u70b9\u6ca1\u6709\u513f\u5b50\uff0c\u5373\u4e3a\u53f6\u8282\u70b9\u3002\u90a3\u4e48\uff0c\u76f4\u63a5\u5c06\u8be5\u8282\u70b9\u5220\u9664\u5c31OK\u4e86\u3002\r\n       \u2461 \u88ab\u5220\u9664\u8282\u70b9\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\u3002\u90a3\u4e48\uff0c\u76f4\u63a5\u5220\u9664\u8be5\u8282\u70b9\uff0c\u5e76\u7528\u8be5\u8282\u70b9\u7684\u552f\u4e00\u5b50\u8282\u70b9\u9876\u66ff\u5b83\u7684\u4f4d\u7f6e\u3002\r\n       \u2462 \u88ab\u5220\u9664\u8282\u70b9\u6709\u4e24\u4e2a\u513f\u5b50\u3002\u90a3\u4e48\uff0c\u5148\u627e\u51fa\u5b83\u7684\u540e\u7ee7\u8282\u70b9\uff1b\u7136\u540e\u628a\u201c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u7684\u5185\u5bb9\u201d\u590d\u5236\u7ed9\u201c\u8be5\u8282\u70b9\u7684\u5185\u5bb9\u201d\uff1b\u4e4b\u540e\uff0c\u5220\u9664\u201c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u201d\u3002\u5728\u8fd9\u91cc\uff0c\u540e\u7ee7\u8282\u70b9\u76f8\u5f53\u4e8e\u66ff\u8eab\uff0c\u5728\u5c06\u540e\u7ee7\u8282\u70b9\u7684\u5185\u5bb9\u590d\u5236\u7ed9\"\u88ab\u5220\u9664\u8282\u70b9\"\u4e4b\u540e\uff0c\u518d\u5c06\u540e\u7ee7\u8282\u70b9\u5220\u9664\u3002\u8fd9\u6837\u5c31\u5de7\u5999\u7684\u5c06\u95ee\u9898\u8f6c\u6362\u4e3a\"\u5220\u9664\u540e\u7ee7\u8282\u70b9\"\u7684\u60c5\u51b5\u4e86\uff0c\u4e0b\u9762\u5c31\u8003\u8651\u540e\u7ee7\u8282\u70b9\u3002 \u5728\"\u88ab\u5220\u9664\u8282\u70b9\"\u6709\u4e24\u4e2a\u975e\u7a7a\u5b50\u8282\u70b9\u7684\u60c5\u51b5\u4e0b\uff0c\u5b83\u7684\u540e\u7ee7\u8282\u70b9\u4e0d\u53ef\u80fd\u662f\u53cc\u5b50\u975e\u7a7a\u3002\u65e2\u7136\"\u7684\u540e\u7ee7\u8282\u70b9\"\u4e0d\u53ef\u80fd\u53cc\u5b50\u90fd\u975e\u7a7a\uff0c\u5c31\u610f\u5473\u7740\"\u8be5\u8282\u70b9\u7684\u540e\u7ee7\u8282\u70b9\"\u8981\u4e48\u6ca1\u6709\u513f\u5b50\uff0c\u8981\u4e48\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\u3002\u82e5\u6ca1\u6709\u513f\u5b50\uff0c\u5219\u6309\"\u60c5\u51b5\u2460 \"\u8fdb\u884c\u5904\u7406\uff1b\u82e5\u53ea\u6709\u4e00\u4e2a\u513f\u5b50\uff0c\u5219\u6309\"\u60c5\u51b5\u2461 \"\u8fdb\u884c\u5904\u7406\u3002\r\n\r\n\u7b2c\u4e8c\u6b65\uff1a\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u7b49\u4e00\u7cfb\u5217\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002\r\n       \u56e0\u4e3a\"\u7b2c\u4e00\u6b65\"\u4e2d\u5220\u9664\u8282\u70b9\u4e4b\u540e\uff0c\u53ef\u80fd\u4f1a\u8fdd\u80cc\u7ea2\u9ed1\u6811\u7684\u7279\u6027\u3002\u6240\u4ee5\u9700\u8981\u901a\u8fc7\"\u65cb\u8f6c\u548c\u91cd\u65b0\u7740\u8272\"\u6765\u4fee\u6b63\u8be5\u6811\uff0c\u4f7f\u4e4b\u91cd\u65b0\u6210\u4e3a\u4e00\u68f5\u7ea2\u9ed1\u6811\u3002","add_time":"2016-11-28 11:16:39","up_time":"--"}];

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
