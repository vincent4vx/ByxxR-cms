<?php
/*
 * Core.php
 * charge tout le système.
 */
class Core
{
    public static $config;
    
    public function __construct()
    {
	$this->includes();
	Loader::load_class('Output');
	Loader::load_class('Router');
    }
    
    public function includes()
    {
	self::$config=require_once BASE.'config/main'.EXT;
	require_once CORE.'Loader'.EXT;
	require_once CORE.'components/BaseComponent'.EXT;
	require_once CORE.'components/Controller'.EXT;
	require_once CORE.'components/Model'.EXT;
    }
    
    public function run()
    {
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
    }
    
    public function display()
    {
	Loader::getClass('Output')->display();
    }
}