<?php
/*
 * Core.php
 * charge tout le système.
 */
class Core
{
    public static $config;
    
    public static $benchmarks;


    public function __construct()
    {
	$this->includes();
	Loader::load_class('Output');
	Loader::load_class('Router');
	self::$benchmarks['Loading Core']=number_format(microtime(true)-START_TIME, 4).'sec';
	self::$benchmarks['Core memory use']=memory_get_usage().' Bytes';
    }
    
    public function includes()
    {
	self::$config=require_once BASE.'config/main'.EXT;
	require_once CORE.'Loader'.EXT;
	require_once CORE.'MVC/BaseComponent'.EXT;
	require_once CORE.'MVC/Controller'.EXT;
	require_once CORE.'MVC/Model'.EXT;
	require_once CORE.'MVC/View'.EXT;
    }
    
    public function run()
    {
	$time=microtime(true);
	$error=Loader::getClass('Router')->load_page();
	if($error===false or is_int($error))
	{
	    switch ($error)
	    {
		case 45: echo 'NO_FILE';
		    break;
		case 46: echo 'NO_CLASS';
		    break;
		case false: echo 'NO_METHOD';
		    break;
	    }
	}
	self::$benchmarks['Loading controller']=number_format(microtime(true)-$time,4).'sec';
    }
    
    public function display()
    {
	$time=microtime(true);
	Loader::getClass('Output')->display();
	self::$benchmarks['Display']=number_format(microtime(true)-$time,4).'sec';
    }
    
    public function benchmarks()
    {
	self::$benchmarks['Total execution time']=number_format(microtime(true)-START_TIME, 4).'sec';
	self::$benchmarks['Total memory use']=memory_get_usage().' Bytes';
	echo '<table>';
	foreach (self::$benchmarks as $title=>$value)
	{
	    echo '<tr><td>'.$title.'</td><td>'.$value.'</td></tr>';
	}
	echo '</table>';
    }
}