<?php
class Session
{
    protected $cache;
    protected $cache_param=array();
    
    protected $config;
    protected $SESSID;
    protected $_vars=array();
    protected $update=false;


    protected $logged=false;
    protected $admin=false;
    protected $super_admin=false;


    public function __get($name) {
	if(isset($this->_vars[$name]))
	    return $this->_vars[$name];
	return false;
    }
    
    public function __set($name, $value) {
	$this->update=true;
	$this->_vars[$name]=$value;
    }

    public function __construct() {
	$this->config=&Core::$config;
	if(!isset($_COOKIE[$this->config['session']['cookie_name']]))
	{
	    $this->SESSID=hash('sha256', md5(rand(-100, 100)).uniqid());
	    setcookie($this->config['session']['cookie_name'], $this->SESSID, 0, '/');
	}else
	    $this->SESSID=$_COOKIE[$this->config['session']['cookie_name']];
	
	$this->cache=&Loader::getClass('Cache');
	$this->cache_param=array(
	    'driver'=>$this->config['session']['driver'],
	    'path'=>'session',
	);
	
	if(($data=$this->cache->get($this->SESSID, $this->cache_param))!==false)
	{
	    $this->_vars=$data;
	    $this->logged=true;
	    if($this->_vars['level']>=$this->config['admin']['level'])
		$this->admin=true;
	    if($this->_vars['guid']==$this->config['admin']['super_admin'])
	    {
		$this->admin=true;
		$this->super_admin=true;
	    }
	    if($this->_vars['REMOTE_ADDR']!==$_SERVER['REMOTE_ADDR'])
		$this->destroy();
	}
    }
    
    public function destroy()
    {
	$this->_vars=array();
	$this->logged=false;
	$this->admin=false;
	$this->super_admin=false;
	$this->update=false;
	$this->cache->delete($this->SESSID, $this->cache_param);
    }
    
    public function isLog()
    {
	return $this->logged;
    }
    
    public function isAdmin()
    {
	return $this->admin;
    }
    
    public function superAdmin()
    {
	return $this->super_admin;
    }
    
    public function __destruct() {
	if($this->_vars===array())
	    return;
	if($this->update===true or $this->_vars['last_update']+$this->config['session']['update']<time())
	{
	    $this->_vars['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];
	    $this->cache->set($this->SESSID, $this->_vars, $this->config['destroy'], $this->cache_param);
	}
    }
}

