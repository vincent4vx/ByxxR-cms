<?php
/*
 * class mère des controllers
 */
class controller
{
    protected $cache;
    protected $output;
    protected $config;
    protected $session;


    public function __construct()
    {
        global $output, $session, $cache;
	$this->cache =& $cache;
        $this->session =& $session;
        $this->output =& $output;
        $this->config =& $GLOBALS['config'];
    }
    
    protected function model($name, $param = null)
    {
        include APP.'models/'.$name.'Model'.EXT;
        return new $name($param);
    }
}
