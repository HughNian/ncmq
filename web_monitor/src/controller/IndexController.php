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
	public function __construct()
	{
		parent::__construct();
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
    	$this->_tpl->assign('title', 'ncmq监控系统');
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
    	
    	$this->_tpl->assign('title', 'ncmq监控系统');
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
    	
    	$cacheArr = json_decode($cacheJson, 1);
    	
    	$data = array();
    	foreach($cacheArr as $val){
    		$key = key($val);
    		$value = current($val);
    		$data[$key][] = $value;
    	}
    	
    	$this->_tpl->assign('data', $data);
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