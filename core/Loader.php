<?php
class Loader
{
    public static $instance=array();
    
    const NO_FILE=45;
    const NO_CLASS=46;

    public static function load_class($class_name, $alias_name=false)
    {
	$path=array(CORE, CORE.'helpers/', APP.'controllers/', APP.'models/');
	$ok=false;
	foreach($path as $dir)
	{
	    if(file_exists($dir.$class_name.EXT))
	    {
	        require $dir.$class_name.EXT;
		$ok=true;
	        break;
	    }
	}
	if(!$ok)
	    return self::NO_FILE;
	if(!class_exists($class_name))
	    return self::NO_CLASS;
	$class=new $class_name;
	$alias_name = $alias_name===false?$class_name:$alias_name;
	self::$instance[$alias_name]=&$class;
	return true;
    }
    
    public static function manualLoad(&$class, $name)
    {
	self::$instance[$name]=&$class;
    }


    public static function &getClass($name, $alias_name=false)
    {
	if(!isset(self::$instance[$name]) && !isset(self::$instance[$alias_name]))
	{
	    $error=self::load_class($name, $alias_name);
	    if($error!==true)
		return $error;
	    $alias_name=$alias_name===false?$name:$alias_name;
	    return self::$instance[$alias_name];
	}
	if(isset(self::$instance[$name]))
	{
	    $class=&self::$instance[$name];
	    if($alias_name!==false)
		self::$instance[$alias_name]=&$class;
	    return $class;
	}
	return self::$instance[$alias_name];
    }
    
    public static function isLoad($class)
    {
	return isset(self::$instance[$class]);
    }
    
    public static function countClass()
    {
	return count(self::$instance);
    }
}
