<?php
class Session
{
    /**
     * The cache système
     * @var Cache
     */
    protected $cache;
    /**
     * The key for cache
     * @var string
     */
    protected $cache_key;
    
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
	$this->config=&Core::get_instance()->config;
	$this->cache=&Core::get_instance()->loader->get('Cache');
        
	if(!isset($_COOKIE[$this->config['session']['cookie_name']]))
	{
	    $this->SESSID=hash('sha256', md5(rand(-100, 100)).uniqid());
	    setcookie($this->config['session']['cookie_name'], $this->SESSID, 0, '/');
	}else
	    $this->SESSID=$_COOKIE[$this->config['session']['cookie_name']];

        $this->cache_key = $this->config['session']['driver'].':sessions.'.$this->SESSID;
	
	if(($data=$this->cache->get($this->cache_key))!==null)
            $this->login($data, false);
    }

    /**
     * Set the data in the session and logon
     * @param array $data
     */
    public function login(array &$data, $new = true){
	$this->_vars=&$data;
	$this->logged=true;
	if($this->_vars['level']>=$this->config['admin']['level'])
            $this->admin=true;
	if($this->_vars['guid']==$this->config['admin']['super_admin']){
            $this->admin=true;
            $this->super_admin=true;
	}

        if($new){
            $this->update = true;
            $this->_vars['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];
        }elseif($this->_vars['REMOTE_ADDR']!==$_SERVER['REMOTE_ADDR'])
            $this->destroy();
    }
    
    public function destroy()
    {
	$this->_vars=array();
	$this->logged=false;
	$this->admin=false;
	$this->super_admin=false;
	$this->update=false;
	$this->cache->delete($this->cache_key);
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
	if($this->update===true){
	    $this->cache->set($this->cache_key, $this->_vars, $this->config['session']['destroy']);
	}
    }
}

