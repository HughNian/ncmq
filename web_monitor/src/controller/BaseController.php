<?php
defined('APP_PATH') or die('No direct access allowed.');

/**
 * 控制器基类
 * 
 * @author niansong
 * @version  1.0
 * @package  API
 * 
 */
class BaseController
{
	protected $_tpl;
	protected $ret_val = array();
	
	public function __construct()
	{
		//smarty配置
		$this->_tpl = new Smarty;
		$this->_tpl->debugging       = false;
		$this->_tpl->caching         = false;
		$this->_tpl->cache_lifetime  = 120;
		$this->_tpl->left_delimiter  = "<!--{";
		$this->_tpl->right_delimiter = "}-->";
		$this->_tpl->compile_dir     = ROOT_PATH . TPL . 'compile/'; //设置编译目录
		$this->_tpl->cache_dir       = ROOT_PATH . TPL . 'cache/';   //缓存文件夹
	}
	
	/**
	 * 输出结果集
	 * 
	 */
	protected function result()
	{
		extract($this->ret_val, EXTR_OVERWRITE);
		
		$jsoncallback = FuncHelper::json();
		
		$y['code']  = 200;
		$y['msg']   = 'success';
		$y['data']  = $data;
		
		$tt = $jsoncallback."(".(json_encode($y)).")";
		
		exit($tt);
	}
	
	/**
	 * 输出错误信息
	 * 
	 */
	protected function error($code, $msg)
	{	
		$jsoncallback = FuncHelper::json();
		
		$y['code']  = $code;
		$y['msg']   = $msg;
		$y['data']  = array();
		
		$tt = $jsoncallback."(".(json_encode($y)).")";
		exit($tt);
	}
	
	/**
	 * 检测接口必填参数
	 * 
	 * @param {string} 参数名称 xxx,xxx,xxx 形式
	 * 
	 */
	protected function check($params)
	{
		if(!$params) return;
		
		global $G; //GET参数全局变量
		
		$param_arr = explode(',', $params);
		foreach($param_arr as $param){
			if(!isset($G["$param"]) || !$G["$param"]){
				$this->error(101,"缺少参数$param");
			}
		}
	}
	
	/**
	 * 保存登陆用户信息到session
	 * 
	 */
	protected function saveUser($userid, $username)
	{
		$_SESSION['userid'] = $userid;
		$_SESSION['username'] = $username;
	}
	
	/**
	 * 获取登陆用户信息
	 * 
	 */
	protected function getUserInfo()
	{
		return array(
			'userid' => $_SESSION['userid'],
			'username' => $_SESSION['username']
		);
		
	}
	
	/**
	 * 检测用户是否登陆
	 * 
	 */
	protected function checkLogin()
	{
		if(isset($_SESSION['userid']) && isset($_SESSION['username']))
			return true;
		else
			return false;
	}
	
	/**
	 * 获取POST入参
	 * 
	 */
	protected function postp($name, $default = '')
	{
		if($_POST[$name]){
			return $_POST[$name];
		} else {
			return $default;
		}
	}
}