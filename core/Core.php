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
    public static $benchmarks;
    public $lang=array();
    /**
     * get the loader instance
     * @var Loader
     */
    public $loader;
    /**
     * Globals vars
     * @var array
     */
    public $globals = array();


    public function __construct()
    {
        self::$instance =& $this;
        $this->config = require_once BASE.'config/main.php';
        require_once CORE.'Loader'.EXT;
        $this->loader = new Loader();
        $this->loader->preload();
    }
    
    public function run()
    {
	$time=microtime(true);
	/*$error=Loader::getClass('Router')->load_page();
	if($error!==null)
	{
	    if($error===404 or $error===Loader::NO_CLASS or $error===Loader::NO_FILE)
		Loader::getClass('Output')->error_404();
	    elseif($error===403)
		Loader::getClass('Output')->error_403();
	}*/
        $this->loader->get('router')->run();
    }
    
    public function display()
    {
	$time=microtime(true);
	$this->loader->get('Output')->display();
    }
    
    public function benchmarks()
    {
        if($this->loader->get('Router')->ext !== '.html'){
            return;
        }
	self::$benchmarks['Total execution time']=number_format(number_format((microtime(true)-START_TIME)*1000, 4), 1).'ms';
	self::$benchmarks['Total memory use']=number_format(memory_get_usage() / 1024).' Ko';
        self::$benchmarks['Queries']=Database::$num_req;
	echo '<table>';
	foreach (self::$benchmarks as $title=>$value)
	{
	    echo '<tr><td>'.$title.'</td><td>'.$value.'</td></tr>';
	}
	echo '</table>';
    }

    /**
     * get the current instance
     * @return Core
     */
    public static function &get_instance(){
        return self::$instance;
    }

    /**
     * get a config param
     * @param string $keys
     * @return mixed
     */
    public static function conf($keys){
        $keys = explode('.', $keys);
        $array = self::$instance->config;

        foreach($keys as $key){
            if(isset($array[$key]))
                $array = $array[$key];
            else
                return null;
        }

        return $array;
    }
}