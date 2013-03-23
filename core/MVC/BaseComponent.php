<?php
/**
 * @property-read Ouput $output The output class
 * @property-read Session $session Session class
 */
class BaseComponent
{
    /**
     * The config data
     * @var array
     */
    protected $config;
    /**
     * The Loader instance
     * @var Loader
     */
    protected $loader;
    
    public function __construct()
    {
	$this->config=&Core::get_instance()->config;
        $this->loader=&Core::get_instance()->loader;
    }
    
    public function __get($name)
    {
	if(isset(Core::get_instance()->globals[$name]))
	    return Core::get_instance()->globals[$name];
	return $this->loader->get($name);
    }
    
    public function __set($name, $value)
    {
	Core::get_instance()->globals[$name]=$value;
    }
}
