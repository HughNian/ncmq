<?php
defined('APP_PATH') or die('No direct access allowed.');
/**
 * 系统函数库
 * 
 */

/**
 * 获取配置函数
 *
 */
function C($name = null)
{
    strtolower($name);
    if(!$name) return;

    global $config;
    //最多支持三维
    $confs = explode('.', $name);
    $count = count($confs);
    switch($count){
        case 1:
            return $config[$confs[0]];
            break;
        case 2:
            return $config[$confs[0]][$confs[1]];
            break;
        case 3:
            return $config[$confs[0]][$confs[1]][$confs[2]];
            break;
        default:
            return $config[$confs[0]];
            break;
    }
}

/**
 * 实例化Model函数
 *
 * 参数 $model = "ExamActivities" 无需写Model
 *
 */
function M($model)
{
    $model = $model . 'Model';
    try{
        return new $model();
    } catch(Exception $e) {
        print $e->getMessage();
        exit();
    }

}

/**
 * 异常处理函数
 *
 */
function E($msg, $tag, $code)
{
    ExceptionHelper::throw_exception($msg, $tag, $code);
}

/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @param integer $time 重定向的等待时间（秒）
 * @param string $msg 重定向前的提示信息
 * @return void
 */
function redirect($url, $time=0, $msg='', $tag = 1) {
    //多行URL地址支持
    $url = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg))
        $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            if($tag == 1){
            	$icon = "😎 (*^‧^*)";
            } else {
            	$icon = '😒  @_@|||||';
            }
            
            $head = '<style type="text/css">body{ margin: 40px; background: #fff; font-family: "微软雅黑"; color: #333; font-size: 35px; }</style>';
            $html = "<center>{$icon} {$msg}</center>";
            echo($head . $html);
        }
        exit();
    } else {
        $str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        $str = "";
        if ($time != 0)
            $str .= $msg;
        exit($str);
    }
}