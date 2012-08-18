<?php
class Cache
{
    private $_drivers=array();
    private $default_driver='file';


    public static function drivers()
    {
	return array('apc', 'file', 'database');
    }
    
    private function getDriver(array $param)
    {
	if(isset($param['driver']))
	    return $param['driver'];
	return $this->default_driver;
    }
    
    public function __get($name) {
	if(isset($this->_drivers[$name]))
	    return $this->_drivers[$name];
	$class=ucfirst($name).'Cache';
	$filename=CORE.'cache/drivers/'.$class.EXT;
	if(!file_exists($filename))
	    exit('Cache Driver '.$name.' not found !');
	require_once $filename;
	$this->_drivers[$name]=new $class;
	return $this->_drivers[$name];
    }


    /*
     * fonctions sur le cache
     */
    public function get($id, array $param=array())
    {
	return $this->{$this->getDriver($param)}->get($id, $param);
    }
    
    public function set($id, $value=null, $time=60, array $param=array())
    {
	return $this->{$this->getDriver($param)}->set($id, $value, $time, $param);
    }
    
    public function delete($id, array $param=array())
    {
	return $this->{$this->getDriver($param)}->delete($id, $param);
    }
}
