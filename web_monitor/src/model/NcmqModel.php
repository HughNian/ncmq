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
    	fwrite($this->conn, "set $name $delay\r\n$data\r\n");
    
    	$response = fgets($this->conn);
    	
    	//echo $response;
    	
    	if(strstr($response, 'OK')) {
    		$this->emsg = '添加缓存成功';
    		return true;
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
        fwrite($this->conn, "enqueue $name\r\n$job\r\n");

        $response = fgets($this->conn);
        
        //echo $response;
        
    	if(strstr($response, 'OK')) {
    		$this->emsg = '添加队列成功';
    		return true;
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
    	
    	$size = 1024;
    	$response = $paragraph = fread($this->conn, $size);
    	while($paragraph){
    		$paragraph = fread($this->conn, $size);
    		$response .= $paragraph;
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
    	fwrite($this->conn, "mqueue\r\n");
    	 
    	$response = fread($this->conn);
    	 
    	return $response;
    }
    
    public function touch($name)
    {
        fwrite($this->conn, "touch $name\r\n");
        
        $response = fgets($this->conn);
        if (substr($response, 0, 1) == '+') {
            $response = explode(' ', $response);
            $recycle_id = $response[1];
            $size = $response[2] + 2;
        } else {
            $this->emsg = substr($response, 5);
            return false;
        }
        
        $job = '';
        while (strlen($job) < $size) {
            $job .= fread($this->conn, $size);
        }
        return array('id' => $recycle_id, 'job' => $job);
    }
    
    public function size($name)
    {
        fwrite($this->conn, "size $name\r\n");
        
        $response = fgets($this->conn);
        
        echo $response;
        
        if (substr($response, 0, 1) == '+') {
            $response = explode(' ', $response);
            return $response[1];
        } else {
            $this->emsg = substr($response, 5);
            return false;
        }
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
