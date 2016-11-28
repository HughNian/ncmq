<?php
defined('APP_PATH') or die('No direct access allowed.');

/**
 * 监控管理系统
 * 
 * @author   niansong
 * @version  1.0
 * @package  src
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
    		redirect('/Index/index', 2, '用户不存在', 2);
    	if(C('admin_user')[$userid]['passward'] != md5($password))
    		redirect('/Index/index', 2, '用户密码不正确', 2);
    	
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
    	if(!$this->checkLogin())
    		redirect('/Index/index');
    	
    	$sysinfo = array(
    			'system_version'  => '0.0.1',
    			'php_version'     => PHP_VERSION,
    			'server_software' => php_uname(),
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
    	if(!$this->checkLogin())
    		redirect('/Index/index');
    	
    	$ncmqSocket = M('NcmqSocket');
    	
    	$cacheJson = $ncmqSocket->mcache();
    	
    	$return = array();
    	
    	if($cacheJson){
    		$cacheArr = json_decode($cacheJson, 1);
    		
    		$data = array();
    		$i = 1;
    		foreach($cacheArr as $k => $val){
    			$key = key($val);
    			$value = current($val);
    			$data[$key][] = array('data' => $value, 'add_time' => $val['add_time'], 'up_time' => $val['up_time']);
    		}
    		
    		$return = array();
    		foreach($data as $key => $val){
    			$id = $i;
    			array_push($return, array('id' => $id, 'pId' => 0, 'name' => $key, 'cache' => ''));
    			for($n = 0; $n < count($val); $n++){
    				$cid = $n;    				
    				$add_time = $val[$cid]['add_time'] ? date('Y-m-d H:i:s', $val[$cid]['add_time']) : '--';
    				$up_time = $val[$cid]['up_time'] ? date('Y-m-d H:i:s', $val[$cid]['up_time']) : '--';
    				$cache = $val[$cid]['data'];
    				if(is_array($cache)) $cache = json_encode($cache);
    				array_push($return, array('id' => $id . $cid, 'pId' => $id, 'key' => $key, 'name' => "[id:$cid|key:$key]", 'cache' => $cache, 'add_time' => $add_time, 'up_time' => $up_time));
    			}
    			$i++;
    		}
    	}
    	
    	if($return){
    		$return = json_encode($return);
    	} else {
    		$return = false;
    	}
    	
    	$this->_tpl->assign('title', $this->_title);
    	$this->_tpl->assign('cacheData', $return);
    	$this->_tpl->clearCache('mcache.html');
    	$this->_tpl->display('mcache.html');
    }
    
    /**
     * 队列监控
     * 
     */
    public function mqueue()
    {
    	if(!$this->checkLogin())
    		redirect('/Index/index');
    	
    	$ncmqSocket = M('NcmqSocket');
    	 
    	$queueJson = $ncmqSocket->mqueue();
    	
    	$return = array();
    	 
    	if($queueJson){
    		$queueArr = json_decode($queueJson, 1);
    	
    		$data = array();
    		$i = 1;
    		foreach($queueArr as $val){
    			$key = key($val);
    			$value = current($val);
    			$data[$key][] = array('data' => $value, 'add_time' => $val['add_time'], 'up_time' => $val['up_time']);
    		}
    		 
    		$return = array();
    		foreach($data as $key => $val){
    			$id = $i;
    			array_push($return, array('id' => $id, 'pId' => 0, 'name' => $key, 'cache' => ''));
    			for($n = 0; $n < count($val); $n++){
    				$cid = $n;
    				$add_time = $val[$cid]['add_time'] ? date('Y-m-d H:i:s', $val[$cid]['add_time']) : '--';
    				$up_time = $val[$cid]['up_time'] ? date('Y-m-d H:i:s', $val[$cid]['up_time']) : '--';
    				$queue = $val[$cid]['data'];
    				if(is_array($queue)) $queue = json_encode($queue);
    				array_push($return, array('id' => $id . $cid, 'pId' => $id, 'key' => $key, 'name' => "[id:$cid|key:$key]", 'queue' => $queue, 'add_time' => $add_time, 'up_time' => $up_time));
    			}
    			$i++;
    		}
    	}
    	 
    	if($return){
    		$return = json_encode($return);
    	} else {
    		$return = false;
    	}
    	 
    	$this->_tpl->assign('title', $this->_title);
    	$this->_tpl->assign('queueData', $return);
    	$this->_tpl->clearCache('mqueue.html');
    	$this->_tpl->display('mqueue.html');
    }
    
    /**
     * 缓存管理页面
     * 
     */
   	public function managercache()
   	{
   		if(!$this->checkLogin())
   			redirect('/Index/index');
   		
   		$this->_tpl->assign('title', $this->_title);
   		$this->_tpl->display('addcache.html');
   	}
   	
   	/**
   	 * 添加缓存
   	 * 
   	 */
   	public function addcache()
   	{
   		if(!$this->checkLogin())
   			redirect('/Index/index');
   		
   		$name = $this->postp('name');
   		$cache = $this->postp('cache');
   		$overtime = $this->postp('overtime');
   		
   		if(!$name || !$cache){
   			redirect('/Index/managercache', 3, "提交参数不正确", 2);
   		}
   		
   		if(!$overtime || !preg_match('/^0-9$/', $overtime)) $overtime = 0;
   		
   		$ncmqSocket = M('NcmqSocket');
   		
   		$ret = $ncmqSocket->set($name, $overtime, $cache);
   		
   		if($ret){
   			redirect('/Index/managercache', 3, "添加成功");
   		} else {
   			redirect('/Index/managercache', 3, "添加失败", 2);
   		}
   	}
   	
   	/**
   	 * 队列管理页面
   	 * 
   	 */
   	public function managerqueue()
   	{
   		if(!$this->checkLogin())
   			redirect('/Index/index');
   		
   		$this->_tpl->assign('title', $this->_title);
   		$this->_tpl->display('addqueue.html');
   	}
    
   	/**
   	 * 添加队列
   	 * 
   	 */
   	public function addqueue()
   	{
   		if(!$this->checkLogin())
   			redirect('/Index/index');
   		
   		$name = $this->postp('name');
   		$queue = $this->postp('queue');
   			 
   		if(!$name || !$queue){
   			redirect('/Index/managercache', 3, "提交参数不正确", 2);
   		}
   		
   		$ncmqSocket = M('NcmqSocket');
   		
   		$ret = $ncmqSocket->enqueue($name, $queue);
   			 
   		if($ret){
   			redirect('/Index/managerqueue', 3, "添加成功");
   		} else {
   			redirect('/Index/managerqueue', 3, "添加失败", 2);
   		}
   	}
   	
   	/**
   	 * 系统统计
   	 * 
   	 */
   	public function syschart()
   	{
   		if(!$this->checkLogin())
   			redirect('/Index/index');
   		
   		$week = UtilityHelper::getWeekDay();
   		$cacheArr = $queueArr = array();
   		$cacheChart = $queueChart = array(0,0,0,0,0,0,0);
   		
   		$ncmqSocket = M('NcmqSocket');
   		$cacheJson = $ncmqSocket->mcache();
   		$cacheArr = json_decode($cacheJson, 1);
   		
   		if($cacheArr){
   			$times = array();
   			foreach($cacheArr as $arr){
   				$times[]['time'] = date('Y-m-d', $arr['add_time']);
   			}
   			
   			foreach($week as $key => $day){
   				$i = 0;
   				foreach($times as $val){
   					if($day == $val['time']){
   						$cacheChart[$key] = ++$i;
   					} else {
   						$cacheChart[$key] = 0;
   					}
   				}
   			}
   		}
   		
   		$ncmqSocket = M('NcmqSocket');
   		$queueJson = $ncmqSocket->mqueue();
   		$queueArr = json_decode($queueJson, 1);
   		
   		if($queueArr){
   			$times = array();
   			foreach($queueArr as $arr){
   				$times[]['time'] = date('Y-m-d', $arr['add_time']);
   			}
   		
   			foreach($week as $key => $day){
   				$i = 0;
   				foreach($times as $val){
   					if($day == $val['time']){
   						$queueChart[$key] = ++$i;
   					} else {
   						$queueChart[$key] = 0;
   					}
   				}
   			}
   		}
   		
   		$this->_tpl->assign('cache', json_encode($cacheChart));
   		$this->_tpl->assign('queue', json_encode($queueChart));
   		$this->_tpl->assign('week', json_encode($week));
   		$this->_tpl->assign('title', $this->_title);
   		$this->_tpl->clearCache('syschart.html');
   		$this->_tpl->display('syschart.html');
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