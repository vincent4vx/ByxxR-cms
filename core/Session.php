<?php
class Session
{
    protected $config;
    protected $SESSID;
    protected $_vars=array();
    
    protected $logged=false;
    protected $admin=false;
    protected $super_admin=false;


    public function __get($name) {
	if(isset($this->_vars[$name]))
	    return $this->_vars[$name];
	return false;
    }
    
    public function __set($name, $value) {
	$this->_vars[$name]=$value;
    }

    public function __construct() {
	$this->config=&Core::$config;
	if(!isset($_COOKIE[$this->config['cookie_name']]))
	{
	    $this->SESSID=hash('sha256', md5(rand(-100, 100)).uniqid().'azs544µ*dfgoer+=^$§wq<');
	    setcookie($this->config['cookie_name'], $this->SESSID, 0, '/');
	}else
	    $this->SESSID=$_COOKIE[$this->config['cookie_name']];
	if(($data=apc_fetch('byxxr_session:'.$this->SESSID))!==false)
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
	$key='byxxr_session:'.$this->SESSID;
	if(apc_exists($key))
	    apc_delete ($key);
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
	$key='byxxr_session:'.$this->SESSID;
	if($this->_vars!==array())
	{
	    $this->_vars['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];
	    apc_store($key, $this->_vars, $this->config['destr_session_time']);
	}
    }
}

