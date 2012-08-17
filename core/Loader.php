<?php
class Loader
{
    private static $instance=array();
    private static $count=0;

    const NO_FILE=45;
    const NO_CLASS=46;

    public static function load_class($class)
    {
	$path=array(CORE, CORE.strtolower($class).'/', CORE.'helpers/');
	foreach($path as $dir)
	{
	    if(self::manual_load($class, $dir)===true)
		return true;    
	}
	return false;
    }
    
    public static function manual_load($class, $path)
    {
	$file=$path.$class.EXT;
	if(!file_exists($file))
	    return self::NO_FILE;
	require_once $file;
	if(!class_exists($class))
	    return self::NO_CLASS;
	self::$instance[$class]=new $class;
	self::$count++;
	return true;
    }


    public static function &getClass($class, $path=false)
    {
	if(self::isLoad($class))
	    return self::$instance[$class];
	
	if($path===false)
	    $state=self::load_class($class);
	else
	    $state=self::manual_load ($class, $path);
	if($state!==true)
	    return $state;
	return self::$instance[$class];
    }
    
    public static function isLoad($class)
    {
	return isset(self::$instance[$class]);
    }
    
    public static function countClass()
    {
	return self::$count;
    }
}
