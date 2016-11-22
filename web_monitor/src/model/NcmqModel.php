<?php
defined('APP_PATH') or die('No direct access allowed.');

class NcmqModel
{
    private $conn;
    private $emsg;
    
    public function __construct($host = '127.0.0.1', $port = '21666')
    {
        $this->conn = fsockopen($host, $port, $enum, $emsg);
        if (!$this->conn) {
            exit($emsg);
        }
    }
    
    /**
     * 设置缓存
     * 
     */
    public function set($name, $delay, $data)
    {
    	fwrite($this->conn, "set $name $delay\r\n");
    	usleep(500);
    	fwrite($this->conn, "$data\r\n");
    
    	$count = fgets($this->conn);
    	if($count > 0){
    		$response = fgets($this->conn);
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
        fwrite($this->conn, "enqueue $name\r\n");
        usleep(500);
        fwrite($this->conn, "$job\r\n");
        
        $count = fgets($this->conn);
        
        if($count > 0){
        	$response = fgets($this->conn);
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
    	fwrite($this->conn, "dequeue $name\r\n");
    
    	$response = fread($this->conn);
    	
    	return $response;
    
    }
    
    /**
     * 消费队列
     * 
     */
    public function dequeue($name)
    {
        fwrite($this->conn, "dequeue $name\r\n");
        
        $response = fread($this->conn);
        
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
    	fwrite($this->conn, "mcache\r\n");
    	
    	$response = '';
    	$size = 0;
    	$size = (int)fgets($this->conn);
    	if($size > 0)
    		$response = fread($this->conn, $size);
    	
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
    	fwrite($this->conn, "mqueue\r\n");
    	 
    	$response = '';
    	$size = 0;
    	$size = (int)fgets($this->conn);
    	if($size > 0)
    		$response = fread($this->conn, $size);
    	
    	return $response;
    }

    public function error_message()
    {
        return $this->emsg;
    }
    
    public function __destruct()
    {
    	fclose($this->conn);
    }
}
