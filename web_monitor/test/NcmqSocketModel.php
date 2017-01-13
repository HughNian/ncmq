<?php
class NcmqSocketModel
{	
    private $conn;
    private $emsg;
    
    public function __construct($host = '127.0.0.1', $port = '21666')
    {	
    	$this->conn = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    	socket_set_option($this->conn, SOL_SOCKET,SO_RCVTIMEO, array("sec"=>10, "usec"=>0 ));
    	socket_set_option($this->conn, SOL_SOCKET,SO_SNDTIMEO, array("sec"=>10, "usec"=>0 ));
    	
    	if($this->conn < 0){
    		$this->emsg = 'socket create failed';
    		die($this->emsg);
    	}
    	
    	if(socket_connect($this->conn, $host, $port) < 0){
    		$this->emsg = 'scoket connect failed';
    		die($this->emsg);
    	}
    }
    
    /**
     * 设置缓存
     * 
     */
    public function set($name, $delay, $data)
    {
    	$response = '';
    	
    	$cmd = "set $name $delay\r\n";
    	if(!socket_write($this->conn, $cmd, strlen($cmd))){
    		$this->emsg = 'socket write1 failed';
    		return $response;
    	}
    	usleep(500);
    	$insert = "$data\r\n";
    	if(!socket_write($this->conn, $insert, strlen($insert))){
    		$this->emsg = 'socket write2 failed';
    		return $response;
    	}
    	
    	$size = socket_read($this->conn, 128, PHP_NORMAL_READ);
    	if($size > 0){
    		usleep(500);
    		$response = socket_read($this->conn, intval($size)+10);
    		if(strstr($response, 'OK')) {
    			$this->emsg = '添加缓存成功';
    			return true;
    		} else {
    			$this->emsg = '添加缓存失败';
    			return false;
    		}
    	} else {
    		$this->emsg = '添加缓存失败';
    		return false;
    	}
    }
    
    /**
     * 添加队列
     * 
     */
    public function enqueue($name, $job)
    {
        $response = '';
        
        $cmd = "enqueue $name\r\n";
        if(!socket_write($this->conn, $cmd, strlen($cmd))){
        	$this->emsg = 'socket write1 failed';
        	return $response;
        }
        usleep(500);
        if(!socket_write($this->conn, $job, strlen($job))){
        	$this->emsg = 'socket write2 failed';
        	return $response;
        }
        
        $size = socket_read($this->conn, 128, PHP_NORMAL_READ);
        if($size > 0){
        	usleep(500);
        	$response = socket_read($this->conn, intval($size)+10);
        	if(strstr($response, 'OK')) {
        		$this->emsg = '添加队列成功';
        		return true;
        	} else {
        		$this->emsg = '添加队列失败';
        		return false;
        	}
        } else {
        	$this->emsg = '添加队列失败';
        	return false;
        }
    }
    
    /**
     * 获取缓存
     *
     */
    public function get($name)
    {
    	$response = '';
    	 
    	$cmd = "get $name\r\n";
    	if(!socket_write($this->conn, $cmd, strlen($cmd))){
    		$this->emsg = 'socket write failed';
    		return $response;
    	}
    	 
    	$size = socket_read($this->conn, 128, PHP_NORMAL_READ);
    	 
    	if($size > 0){
    		usleep(500);
    		$response = socket_read($this->conn, intval($size)+10);
    	}
    	 
    	return $response;
    }
    
    /**
     * 删除缓存，包括删除某个key值下所有缓存数据，以及删除某个key值指定的缓存数据
     * 
     */
    public function del($name, $nkey = '-1')
    {
    	$response = '';
    	
    	$cmd = "del $name $nkey\r\n";
    	if(!socket_write($this->conn, $cmd, strlen($cmd))){
    		$this->emsg = 'socket write failed';
    		return $response;
    	}
    	
    	$size = socket_read($this->conn, 128, PHP_NORMAL_READ);
    	
    	if($size > 0){
    		usleep(500);
    		$response = socket_read($this->conn, intval($size)+10);
    	}
    	
    	return $response;
    }
    
    /**
     * 消费队列
     * 
     */
    public function dequeue($name)
    {
        $response = '';
         
        $cmd = "dequeue $name\r\n";
        if(!socket_write($this->conn, $cmd, strlen($cmd))){
        	$this->emsg = 'socket write failed';
        	return $response;
        }
         
        $size = socket_read($this->conn, 128, PHP_NORMAL_READ);
         
        if($size > 0){
        	usleep(500);
        	$response = socket_read($this->conn, intval($size)+10);
        }
         
        return $response;
        
    }
    
    /**
     * 获取所有缓存 
     *
     * @return json
     *
     */
    public function mcache()
    {
    	$response = '';
    	
    	$cmd = "mcache\r\n";
    	if(!socket_write($this->conn, $cmd, strlen($cmd))){
    		$this->emsg = 'socket write failed';
    		return $response;
    	}
    	
    	$size = socket_read($this->conn, 128, PHP_NORMAL_READ);
    	
    	if($size > 0){
    		usleep(500);
    		//socket_set_option($this->conn, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>10, "usec"=>0));
    		$response = socket_read($this->conn, intval($size)+10);
    	}
    	
    	return $response;
    }
    
    /**
     * 获取所有队列
     *
     * @return json
     *
     */
    public function mqueue()
    {
    	$response = '';
    	
    	$cmd = "mqueue\r\n";
    	if(!socket_write($this->conn, $cmd, strlen($cmd))){
    		$this->emsg = 'socket write failed';
    		return $response;
    	}
    	
    	$size = socket_read($this->conn, 128, PHP_NORMAL_READ);
    	
    	if($size > 0){
    		usleep(500);
    		$response = socket_read($this->conn, intval($size)+10);
    	}
    	
    	return $response;
    }
    
    public function error_message()
    {
        return $this->emsg;
    }
    
	public function __destruct()
    {
     	socket_close($this->conn);
    }
    
}
