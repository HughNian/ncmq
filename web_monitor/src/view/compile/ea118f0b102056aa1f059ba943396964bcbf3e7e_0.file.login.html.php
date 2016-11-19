<?php
/* Smarty version 3.1.30, created on 2016-11-19 17:04:44
  from "/home/niansong/C/test/ncmq/web_monitor/src/view/Index/login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583015ac5562c6_87448295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea118f0b102056aa1f059ba943396964bcbf3e7e' => 
    array (
      0 => '/home/niansong/C/test/ncmq/web_monitor/src/view/Index/login.html',
      1 => 1479533947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_583015ac5562c6_87448295 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
	<head>
		<meta charset="<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
" />
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<meta name="robots" content="noindex,nofollow">
		<link href="/public/css/admin/admin_login.css" rel="stylesheet" />
		<style type="text/css">
			img {cursor:pointer}
		</style>
		<?php echo '<script'; ?>
>
			//全局变量
			var GV = {
				JS_ROOT : "/Public/js/admin/",	//js目录
				JS_VERSION : "20130702",		//js版本号
				TOKEN : 'fef5c12b6aceb78b',	//token ajax全局
				REGION_CONFIG : {},
				SCHOOL_CONFIG : {},
				URL : {
					LOGIN : '/index',				//后台登录地址
					IMAGE_RES: '/Public/images/admin',		//图片目录
				}
			};
			if (window.parent !== window.self) {
					document.write = '';
					window.parent.location.href = window.self.location.href;
					setTimeout(function () {
							document.body.innerHTML = '';
					}, 0);
			}
		<?php echo '</script'; ?>
>
	</head>
<body>
	<div class="wrap">
		<h1><a href="/index">后台管理中心</a></h1>
		<form method="post" name="login" action="/index/login" autoComplete="off">
			<div class="login">
				<ul>
					<li>
						<input class="input" id="J_admin_name" required name="username" type="text" placeholder="帐号名" title="帐号名" />
					</li>
					<li>
						<input class="input" id="admin_pwd" type="password" required name="password" placeholder="密码" title="密码" />
					</li>
				</ul>
				<button type="submit" name="submit" class="btn">登录</button>
			</div>
		</form>
	</div>
<?php echo '<script'; ?>
 src="/public/js/admin/wind.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/admin/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/admin/pages/common/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
;(function(){
	document.getElementById('J_admin_name').focus();
})();

function changeCaptcha()
{
	document.getElementById('checkCodeImage').src='/index/showcaptcha?' + (new Date()).valueOf(); 
}

<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
