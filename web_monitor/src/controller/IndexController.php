<?php
defined('APP_PATH') or die('No direct access allowed.');

/**
 * 首页接口
 * 
 * @author   niansong
 * @version  1.0
 * @package  API
 * 
 */
class IndexController extends BaseController
{
	public $_title;
	
	public function __construct()
	{
		parent::__construct();
		$this->_title = C('sys_name');
		$tplDir = ROOT_PATH . TPL . 'Index/';
		$this->_tpl->setTemplateDir($tplDir);
		
	}
	
    /**
     * 首页登陆页面
     *
     */
    public function index($G = array())
    {
    	$this->_tpl->assign('charset', 'utf-8');
    	$this->_tpl->assign('title', $this->_title);
        $this->_tpl->display('login.html');
    }
    
    /**
     * 登陆功能
     * 
     */
    public function login()
    {
    	$username = $this->postp('username');
    	$password = $this->postp('password');
    	
    	$userexists = 0;
    	$userid = 0;
    	foreach(C('admin_user') as $id => $user){
    		if($user['username'] == $username){
    			$userexists = 1;
    			$userid = $id;
    			break;
    		}
    	}
	
    	if(!$userexists)
    		redirect('/Index/index', 3, '用户不存在');
    	if(C('admin_user')[$userid]['passward'] != md5($password))
    		redirect('/Index/index', 3, '用户密码不正确');
    	
    	$this->saveUser($userid, $username);
    	
    	redirect('/Index/main');
    }
    
    /**
     * 系统主界面
     * 
     */
    public function main()
    {
    	if(!$this->checkLogin())
    		redirect('/Index/index');
    	
    	$data = C('menu');
    	$menus;
    	foreach($data as $key => $val){
    		if($val['pid'] == 0){
    			$menus[$val['id']] = $val;
    		} else {
    			foreach($menus as $k => $v){
    				if($v['id'] == $val['pid']){
    					$menus[$k]['items'][] = $val;
    				}
    			}
    		}
    	}
    	$userInfo = $this->getUserInfo();
    	
    	$this->_tpl->assign('menu', json_encode($menus));
    	$this->_tpl->assign('userinfo', (object)$userInfo);
    	$this->_tpl->display('main.html');
    }
    
    /**
     * 后台首页
     * 
     */
    public function default()
    {
    	$sysinfo = array(
    			'system_version'  => '0.0.1',
    			'php_version'     => PHP_VERSION,
    			'server_software' =>  php_uname(),
    			'max_upload'      => ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'Disabled',
    			'max_excute_time' => intval(ini_get('max_execution_time')) . ' seconds',
    	);
    	
    	$this->_tpl->assign('title', $this->_title);
    	$this->_tpl->assign('sysinfo', $sysinfo);
    	$this->_tpl->display('default.html');
    }
    
    /**
     * 缓存监控
     * 
     */
    public function mcache()
    {
    	$ncmqModel = M('Ncmq');
    	
    	$cacheJson = $ncmqModel->mcache();
    	$json = '{"success":true,"errorCode":710000,"msg":"OK","data":{"result":[{"2418":[{"price":168,"discount":2,"departureDate":"2016-11-23","beginDate":"2016-11-23","orgCityCode":"1602","dstCityCode":402,"orgCityName":"\u5357\u4eac","dstCityName":"\u798f\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":29,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1602_402\/?start=2016-11-23&type=1"},{"price":186,"discount":1.8,"departureDate":"2016-12-18","beginDate":"2016-12-18","orgCityCode":"1602","dstCityCode":414,"orgCityName":"\u5357\u4eac","dstCityName":"\u53a6\u95e8","flightType":"2","flightSource":"1","sortBy":"1","key_id":30,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1602_414\/?start=2016-12-18&type=1"},{"price":208,"discount":1.7,"departureDate":"2016-11-23","beginDate":"2016-11-23","orgCityCode":"1602","dstCityCode":2413,"orgCityName":"\u5357\u4eac","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":31,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1602_2413\/?start=2016-11-23&type=1"},{"price":289,"discount":3,"departureDate":"2016-12-12","beginDate":"2016-12-12","orgCityCode":"1602","dstCityCode":502,"orgCityName":"\u5357\u4eac","dstCityName":"\u5170\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":32,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1602_502\/?start=2016-12-12&type=1"},{"price":847,"discount":4.3,"departureDate":"2016-11-28","beginDate":"2016-11-28","orgCityCode":1602,"dstCityCode":"906","orgCityName":"\u5357\u4eac","dstCityName":"\u4e09\u4e9a","flightType":"2","flightSource":"1","sortBy":"1","key_id":55,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1602_906\/?start=2016-11-28&type=1"},{"price":134,"discount":1.5,"departureDate":"2016-12-06","beginDate":"2016-12-06","orgCityCode":"2500","dstCityCode":2413,"orgCityName":"\u4e0a\u6d77","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":1,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2500_2413\/?start=2016-12-06&type=1"},{"price":174,"discount":1.5,"departureDate":"2016-11-24","beginDate":"2016-11-24","orgCityCode":"2500","dstCityCode":1002,"orgCityName":"\u4e0a\u6d77","dstCityName":"\u77f3\u5bb6\u5e84","flightType":"2","flightSource":"1","sortBy":"1","key_id":2,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2500_1002\/?start=2016-11-24&type=1"},{"price":174,"discount":1.8,"departureDate":"2016-12-21","beginDate":"2016-12-21","orgCityCode":"2500","dstCityCode":1202,"orgCityName":"\u4e0a\u6d77","dstCityName":"\u90d1\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":3,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2500_1202\/?start=2016-12-21&type=1"},{"price":174,"discount":1,"departureDate":"2016-12-03","beginDate":"2016-12-03","orgCityCode":"2500","dstCityCode":1802,"orgCityName":"\u4e0a\u6d77","dstCityName":"\u957f\u6625","flightType":"2","flightSource":"1","sortBy":"1","key_id":4,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2500_1802\/?start=2016-12-03&type=1"},{"price":214,"discount":2.5,"departureDate":"2016-12-26","beginDate":"2016-12-26","orgCityCode":"619","dstCityCode":702,"orgCityName":"\u6df1\u5733","dstCityName":"\u5357\u5b81","flightType":"2","flightSource":"1","sortBy":"1","key_id":5,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_619_702\/?start=2016-12-26&type=1"},{"price":240,"discount":1.9,"departureDate":"2016-12-19","beginDate":"2016-12-19","orgCityCode":"619","dstCityCode":1619,"orgCityName":"\u6df1\u5733","dstCityName":"\u65e0\u9521","flightType":"2","flightSource":"1","sortBy":"1","key_id":6,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_619_1619\/?start=2016-12-19&type=1"},{"price":280,"discount":2,"departureDate":"2016-12-08","beginDate":"2016-12-08","orgCityCode":"619","dstCityCode":1602,"orgCityName":"\u6df1\u5733","dstCityName":"\u5357\u4eac","flightType":"2","flightSource":"1","sortBy":"1","key_id":7,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_619_1602\/?start=2016-12-08&type=1"},{"price":280,"discount":3.3,"departureDate":"2016-12-13","beginDate":"2016-12-13","orgCityCode":"619","dstCityCode":1702,"orgCityName":"\u6df1\u5733","dstCityName":"\u5357\u660c","flightType":"2","flightSource":"1","sortBy":"1","key_id":8,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_619_1702\/?start=2016-12-13&type=1"},{"price":117,"discount":1,"departureDate":"2016-11-25","beginDate":"2016-11-25","orgCityCode":"300","dstCityCode":502,"orgCityName":"\u91cd\u5e86","dstCityName":"\u5170\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":9,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_300_502\/?start=2016-11-25&type=1"},{"price":135,"discount":1,"departureDate":"2016-11-21","beginDate":"2016-11-21","orgCityCode":"300","dstCityCode":2702,"orgCityName":"\u91cd\u5e86","dstCityName":"\u897f\u5b89","flightType":"2","flightSource":"1","sortBy":"1","key_id":10,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_300_2702\/?start=2016-11-21&type=1"},{"price":167,"discount":1.4,"departureDate":"2016-11-29","beginDate":"2016-11-29","orgCityCode":"300","dstCityCode":1202,"orgCityName":"\u91cd\u5e86","dstCityName":"\u90d1\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":11,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_300_1202\/?start=2016-11-29&type=1"},{"price":175,"discount":1.8,"departureDate":"2016-12-08","beginDate":"2016-12-08","orgCityCode":"300","dstCityCode":3302,"orgCityName":"\u91cd\u5e86","dstCityName":"\u6606\u660e","flightType":"2","flightSource":"1","sortBy":"1","key_id":12,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_300_3302\/?start=2016-12-08&type=1"},{"price":188,"discount":0.9,"departureDate":"2016-11-24","beginDate":"2016-11-24","orgCityCode":"2802","dstCityCode":3102,"orgCityName":"\u6210\u90fd","dstCityName":"\u4e4c\u9c81\u6728\u9f50","flightType":"2","flightSource":"1","sortBy":"1","key_id":13,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2802_3102\/?start=2016-11-24&type=1"},{"price":269,"discount":2.7,"departureDate":"2016-12-07","beginDate":"2016-12-07","orgCityCode":"2802","dstCityCode":3302,"orgCityName":"\u6210\u90fd","dstCityName":"\u6606\u660e","flightType":"2","flightSource":"1","sortBy":"1","key_id":14,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2802_3302\/?start=2016-12-07&type=1"},{"price":280,"discount":2.7,"departureDate":"2016-11-23","beginDate":"2016-11-23","orgCityCode":"2802","dstCityCode":1202,"orgCityName":"\u6210\u90fd","dstCityName":"\u90d1\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":15,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2802_1202\/?start=2016-11-23&type=1"},{"price":296,"discount":1.8,"departureDate":"2016-12-06","beginDate":"2016-12-06","orgCityCode":"2802","dstCityCode":3000,"orgCityName":"\u6210\u90fd","dstCityName":"\u5929\u6d25","flightType":"2","flightSource":"1","sortBy":"1","key_id":16,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2802_3000\/?start=2016-12-06&type=1"},{"price":165,"discount":2.3,"departureDate":"2016-12-10","beginDate":"2016-12-10","orgCityCode":"200","dstCityCode":1906,"orgCityName":"\u5317\u4eac","dstCityName":"\u5927\u8fde","flightType":"2","flightSource":"1","sortBy":"1","key_id":17,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_200_1906\/?start=2016-12-10&type=1"},{"price":204,"discount":2,"departureDate":"2016-12-04","beginDate":"2016-12-04","orgCityCode":"200","dstCityCode":1802,"orgCityName":"\u5317\u4eac","dstCityName":"\u957f\u6625","flightType":"2","flightSource":"1","sortBy":"1","key_id":18,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_200_1802\/?start=2016-12-04&type=1"},{"price":220,"discount":3.4,"departureDate":"2016-12-26","beginDate":"2016-12-26","orgCityCode":"200","dstCityCode":1602,"orgCityName":"\u5317\u4eac","dstCityName":"\u5357\u4eac","flightType":"2","flightSource":"1","sortBy":"1","key_id":19,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_200_1602\/?start=2016-12-26&type=1"},{"price":250,"discount":1.8,"departureDate":"2016-12-25","beginDate":"2016-12-25","orgCityCode":"200","dstCityCode":502,"orgCityName":"\u5317\u4eac","dstCityName":"\u5170\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":20,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_200_502\/?start=2016-12-25&type=1"},{"price":214,"discount":1.7,"departureDate":"2016-12-21","beginDate":"2016-12-21","orgCityCode":"602","dstCityCode":1502,"orgCityName":"\u5e7f\u5dde","dstCityName":"\u957f\u6c99","flightType":"2","flightSource":"1","sortBy":"1","key_id":21,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_602_1502\/?start=2016-12-21&type=1"},{"price":219,"discount":2,"departureDate":"2016-12-10","beginDate":"2016-12-10","orgCityCode":"602","dstCityCode":3426,"orgCityName":"\u5e7f\u5dde","dstCityName":"\u6e29\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":22,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_602_3426\/?start=2016-12-10&type=1"},{"price":226,"discount":1.8,"departureDate":"2016-12-14","beginDate":"2016-12-14","orgCityCode":"602","dstCityCode":902,"orgCityName":"\u5e7f\u5dde","dstCityName":"\u6d77\u53e3","flightType":"2","flightSource":"1","sortBy":"1","key_id":23,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_602_902\/?start=2016-12-14&type=1"},{"price":304,"discount":2.7,"departureDate":"2016-12-17","beginDate":"2016-12-17","orgCityCode":"602","dstCityCode":414,"orgCityName":"\u5e7f\u5dde","dstCityName":"\u53a6\u95e8","flightType":"2","flightSource":"1","sortBy":"1","key_id":24,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_602_414\/?start=2016-12-17&type=1"},{"price":95,"discount":1,"departureDate":"2016-11-28","beginDate":"2016-11-28","orgCityCode":"2702","dstCityCode":502,"orgCityName":"\u897f\u5b89","dstCityName":"\u5170\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":25,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2702_502\/?start=2016-11-28&type=1"},{"price":145,"discount":1.3,"departureDate":"2016-11-24","beginDate":"2016-11-24","orgCityCode":"2702","dstCityCode":2712,"orgCityName":"\u897f\u5b89","dstCityName":"\u6986\u6797","flightType":"2","flightSource":"1","sortBy":"1","key_id":26,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2702_2712\/?start=2016-11-24&type=1"},{"price":175,"discount":2.4,"departureDate":"2016-12-03","beginDate":"2016-12-03","orgCityCode":"2702","dstCityCode":1602,"orgCityName":"\u897f\u5b89","dstCityName":"\u5357\u4eac","flightType":"2","flightSource":"1","sortBy":"1","key_id":27,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2702_1602\/?start=2016-12-03&type=1"},{"price":185,"discount":1.5,"departureDate":"2016-12-15","beginDate":"2016-12-15","orgCityCode":"2702","dstCityCode":2413,"orgCityName":"\u897f\u5b89","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":28,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_2702_2413\/?start=2016-12-15&type=1"},{"price":136,"discount":1.3,"departureDate":"2016-12-03","beginDate":"2016-12-03","orgCityCode":"3000","dstCityCode":2702,"orgCityName":"\u5929\u6d25","dstCityName":"\u897f\u5b89","flightType":"2","flightSource":"1","sortBy":"1","key_id":33,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3000_2702\/?start=2016-12-03&type=1"},{"price":166,"discount":1.7,"departureDate":"2016-11-27","beginDate":"2016-11-27","orgCityCode":"3000","dstCityCode":2413,"orgCityName":"\u5929\u6d25","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":34,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3000_2413\/?start=2016-11-27&type=1"},{"price":173,"discount":1.4,"departureDate":"2016-11-23","beginDate":"2016-11-23","orgCityCode":"3000","dstCityCode":1102,"orgCityName":"\u5929\u6d25","dstCityName":"\u54c8\u5c14\u6ee8","flightType":"2","flightSource":"1","sortBy":"1","key_id":35,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3000_1102\/?start=2016-11-23&type=1"},{"price":246,"discount":3.5,"departureDate":"2016-12-03","beginDate":"2016-12-03","orgCityCode":"3000","dstCityCode":2102,"orgCityName":"\u5929\u6d25","dstCityName":"\u547c\u548c\u6d69\u7279","flightType":"2","flightSource":"1","sortBy":"1","key_id":36,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3000_2102\/?start=2016-12-03&type=1"},{"price":130,"discount":1,"departureDate":"2016-12-10","beginDate":"2016-12-10","orgCityCode":"3302","dstCityCode":1502,"orgCityName":"\u6606\u660e","dstCityName":"\u957f\u6c99","flightType":"2","flightSource":"1","sortBy":"1","key_id":37,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3302_1502\/?start=2016-12-10&type=1"},{"price":135,"discount":0.9,"departureDate":"2016-11-30","beginDate":"2016-11-30","orgCityCode":"3302","dstCityCode":2702,"orgCityName":"\u6606\u660e","dstCityName":"\u897f\u5b89","flightType":"2","flightSource":"1","sortBy":"1","key_id":38,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3302_2702\/?start=2016-11-30&type=1"},{"price":168,"discount":1.1,"departureDate":"2016-11-29","beginDate":"2016-11-29","orgCityCode":"3302","dstCityCode":1402,"orgCityName":"\u6606\u660e","dstCityName":"\u6b66\u6c49","flightType":"2","flightSource":"1","sortBy":"1","key_id":39,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3302_1402\/?start=2016-11-29&type=1"},{"price":170,"discount":1.1,"departureDate":"2016-11-28","beginDate":"2016-11-28","orgCityCode":"3302","dstCityCode":1702,"orgCityName":"\u6606\u660e","dstCityName":"\u5357\u660c","flightType":"2","flightSource":"1","sortBy":"1","key_id":40,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3302_1702\/?start=2016-11-28&type=1"},{"price":165,"discount":1.3,"departureDate":"2016-12-07","beginDate":"2016-12-07","orgCityCode":"3402","dstCityCode":2702,"orgCityName":"\u676d\u5dde","dstCityName":"\u897f\u5b89","flightType":"2","flightSource":"1","sortBy":"1","key_id":41,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3402_2702\/?start=2016-12-07&type=1"},{"price":174,"discount":1,"departureDate":"2016-11-29","beginDate":"2016-11-29","orgCityCode":"3402","dstCityCode":1902,"orgCityName":"\u676d\u5dde","dstCityName":"\u6c88\u9633","flightType":"2","flightSource":"1","sortBy":"1","key_id":42,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3402_1902\/?start=2016-11-29&type=1"},{"price":175,"discount":2,"departureDate":"2016-12-17","beginDate":"2016-12-17","orgCityCode":"3402","dstCityCode":414,"orgCityName":"\u676d\u5dde","dstCityName":"\u53a6\u95e8","flightType":"2","flightSource":"1","sortBy":"1","key_id":43,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3402_414\/?start=2016-12-17&type=1"},{"price":175,"discount":2,"departureDate":"2016-12-05","beginDate":"2016-12-05","orgCityCode":"3402","dstCityCode":2413,"orgCityName":"\u676d\u5dde","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":44,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3402_2413\/?start=2016-12-05&type=1"},{"price":155,"discount":1.8,"departureDate":"2016-12-16","beginDate":"2016-12-16","orgCityCode":"414","dstCityCode":102,"orgCityName":"\u53a6\u95e8","dstCityName":"\u5408\u80a5","flightType":"2","flightSource":"1","sortBy":"1","key_id":45,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_414_102\/?start=2016-12-16&type=1"},{"price":180,"discount":2.2,"departureDate":"2016-12-16","beginDate":"2016-12-16","orgCityCode":"414","dstCityCode":3402,"orgCityName":"\u53a6\u95e8","dstCityName":"\u676d\u5dde","flightType":"2","flightSource":"1","sortBy":"1","key_id":46,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_414_3402\/?start=2016-12-16&type=1"},{"price":200,"discount":2,"departureDate":"2016-12-07","beginDate":"2016-12-07","orgCityCode":"414","dstCityCode":1402,"orgCityName":"\u53a6\u95e8","dstCityName":"\u6b66\u6c49","flightType":"2","flightSource":"1","sortBy":"1","key_id":47,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_414_1402\/?start=2016-12-07&type=1"},{"price":200,"discount":2.9,"departureDate":"2016-12-26","beginDate":"2016-12-26","orgCityCode":"414","dstCityCode":1619,"orgCityName":"\u53a6\u95e8","dstCityName":"\u65e0\u9521","flightType":"2","flightSource":"1","sortBy":"1","key_id":48,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_414_1619\/?start=2016-12-26&type=1"},{"price":235,"discount":2,"departureDate":"2016-12-07","beginDate":"2016-12-07","orgCityCode":"1102","dstCityCode":200,"orgCityName":"\u54c8\u5c14\u6ee8","dstCityName":"\u5317\u4eac","flightType":"2","flightSource":"1","sortBy":"1","key_id":49,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1102_200\/?start=2016-12-07&type=1"},{"price":247,"discount":1.7,"departureDate":"2016-12-23","beginDate":"2016-12-23","orgCityCode":"1102","dstCityCode":1002,"orgCityName":"\u54c8\u5c14\u6ee8","dstCityName":"\u77f3\u5bb6\u5e84","flightType":"2","flightSource":"1","sortBy":"1","key_id":50,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1102_1002\/?start=2016-12-23&type=1"},{"price":282,"discount":2.4,"departureDate":"2016-12-01","beginDate":"2016-12-01","orgCityCode":"1102","dstCityCode":2413,"orgCityName":"\u54c8\u5c14\u6ee8","dstCityName":"\u9752\u5c9b","flightType":"2","flightSource":"1","sortBy":"1","key_id":51,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1102_2413\/?start=2016-12-01&type=1"},{"price":350,"discount":2,"departureDate":"2016-11-24","beginDate":"2016-11-24","orgCityCode":"1102","dstCityCode":1602,"orgCityName":"\u54c8\u5c14\u6ee8","dstCityName":"\u5357\u4eac","flightType":"2","flightSource":"1","sortBy":"1","key_id":52,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1102_1602\/?start=2016-11-24&type=1"},{"price":630,"discount":3.8,"departureDate":"2016-12-27","beginDate":"2016-12-27","orgCityCode":3426,"dstCityCode":"906","orgCityName":"\u6e29\u5dde","dstCityName":"\u4e09\u4e9a","flightType":"2","flightSource":"1","sortBy":"1","key_id":53,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_3426_906\/?start=2016-12-27&type=1"},{"price":725,"discount":5.9,"departureDate":"2016-12-25","beginDate":"2016-12-25","orgCityCode":802,"dstCityCode":"906","orgCityName":"\u8d35\u9633","dstCityName":"\u4e09\u4e9a","flightType":"2","flightSource":"1","sortBy":"1","key_id":54,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_802_906\/?start=2016-12-25&type=1"},{"price":909,"discount":4.5,"departureDate":"2016-11-22","beginDate":"2016-11-22","orgCityCode":1202,"dstCityCode":"906","orgCityName":"\u90d1\u5dde","dstCityName":"\u4e09\u4e9a","flightType":"2","flightSource":"1","sortBy":"1","key_id":56,"jumpUrl":"http:\/\/www.tuniu.com\/flight\/city_1202_906\/?start=2016-11-22&type=1"}]}]}}';
    	$cacheArr = json_decode($cacheJson, 1);
    	$arr = json_decode($json, 1);
    	
    	$data = array();
    	$i = 1;
    	foreach($cacheArr as $val){
    		$key = key($val);
    		$value = current($val);
    		$data[$key][] = $value;
    	}
    	
    	array_push($data['haha'], array(array($arr)));
    	
//     	echo '<pre />';
//     	print_r($data);die;
    	
    	$return = array();
    	foreach($data as $key => $val){
    		$id = $i;
    		array_push($return, array('id' => $id, 'pId' => 0, 'name' => $key, 'cache' => ''));
    		for($n = 0; $n < count($val); $n++){
    			$cid = $n;
    			$cache = $val[$cid];
    			if(is_array($cache)) $cache = json_encode($cache);
    			array_push($return, array('id' => $id . $cid, 'pId' => $id, 'key' => $key, 'name' => "[id:$cid|key:$key]", 'cache' => $cache));
    		}
    		$i++;
    	}
    	
//     	echo '<pre />';
//     	print_r($return);die;
// 		echo json_encode($return);die;
    	
    	$this->_tpl->assign('title', $this->_title);
    	$this->_tpl->assign('cacheData', json_encode($return));
    	$this->_tpl->display('mcache.html');
    }
    
    /**
     * 队列监控
     * 
     */
    public function mqueue()
    {
    	
    }
    
    /**
     * 退出
     * 
     */
    public function logout()
    {
    	session_unset();
		session_destroy();
    	
    	redirect('/Index/index');
    }
}