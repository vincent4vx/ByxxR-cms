<?php
/*
 * Core.php
 * charge tout le système.
 */
class Core
{
    /**
     * The instance
     * @var Core
     */
    private static $instance;

    /**
     * the config data
     * @var array
     */
    public $config;
    public $benchmarks;   
    public $lang=array();
    /**
     * get the loader instance
     * @var Loader
     */
    public $loader;


    public function __construct()
    {
        self::$instance =& $this;
	//$this->includes();
	/*Loader::load_class('Output');
	Loader::load_class('Router');*/
        $this->config = require_once BASE.'config/main.php';
        require_once CORE.'Loader'.EXT;
        $this->loader = new Loader();

        trigger_error('oops !');
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
	if($error!==null)
	{
	    if($error===404 or $error===Loader::NO_CLASS or $error===Loader::NO_FILE)
		Loader::getClass('Output')->error_404();
	    elseif($error===403)
		Loader::getClass('Output')->error_403();
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
    
    public static function tr($file, $index)
    {
	if(isset(self::$lang[$file]))
	{
	    return isset(self::$lang[$file][$index]) ? self::$lang[$file][$index] : $index;
	}
	$filename=BASE.'lang/'.self::$config['lang'].'/'.$file.EXT;
	if(!file_exists($filename))
	    return $index;
	
	self::$lang[$file]=require_once $filename;
	
	return self::tr($file, $index);
    }

    /**
     * get the current instance
     * @return Core
     */
    public static function get_instance(){
        return self::$instance;
    }
}