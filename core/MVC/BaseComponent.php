<?php
class BaseComponent
{
    protected $config;
    public $_vars=array();
    
    public function __construct()
    {
	$this->config=&Core::$config;
    }
    
    public function __get($name)
    {
	if(isset($this->_vars[$name]))
	    return $this->_vars[$name];
	return Loader::getClass(ucfirst($name));
    }
    
    public function __set($name, $value)
    {
	$this->_vars[$name]=$value;
    }
}
