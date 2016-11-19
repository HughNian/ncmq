<?php
defined('APP_PATH') or die('No direct access allowed.');

//配置
return $config = array
(
	//是否链接数据 1-是，0-否
	'db_conn' => 0,
		
	//数据库配置
	'db' => array(
		'type' => 'mysql',
		'connection' => array(
			'hostname' => '127.0.0.1',
			'database' => 'yuncms',
			'username' => 'root',
			'password' => '123456',
			'port'     => '3306',
			'persistent' => FALSE,
		),
	),
		
	//缓存队列系统
	'cmq' => array(
		'host' => '127.0.0.1',
		'port' => '21666'
	),
	
	//后台账号密码
	'admin_user' => array(
		'1' => array('username' => 'niansong', 'passward' => '0192023a7bbd73250516f069df18b500'),
		'2' => array('username' => 'admin', 'passward' => '0192023a7bbd73250516f069df18b500'),
	),
		
	//后台菜单
	'menu' => array(
		array('id' => 1, 'pid' => '0', 'url' => '', 'name' => '系统监控'),
		array('id' => 2, 'pid' => '1', 'url' => '/Index/mcache', 'name' => '缓存监控'),
		array('id' => 3, 'pid' => '1', 'url' => '/Index/mqueue', 'name' => '队列监控'),
	),
		
	//默认的一些配置
	'default' => array(
	    'limit'        => 10, //分页数
	    'tmpid'        => 2,  //模板库类型id
	    'dynamicid'    => 11, //润云动态类型父类id
	    'portfolioid'  => 10, //合作加盟类型id
	    'aboutid'      => 9,  //关于润云类型id
	),
);