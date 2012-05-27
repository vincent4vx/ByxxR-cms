<?php
/*
 * loader.php
 * charge tout le système.
 */
/*class core
{
    protected $config;
    protected $session;
    protected $output;
    private $uri;
    
    
    public function __construct()
    {
	$this->config = require_once BASE.'config/main'.EXT;
	$GLOBALS['config'] =& $this->config;
	
	require_once CORE.'session'.EXT;
	$this->session = new session();
	
	require_once CORE.'output'.EXT;
	$this->output = new output();

	require_once CORE.'uri'.EXT;
	$this->uri = new uri();

	require_once CORE.'controller'.EXT;
	require_once CORE.'model'.EXT;
    }
    
    public function loadPage()
    {
	$array_uri = $this->uri->getArrayUri();
	$controller_name = $array_uri[1] === '' ? 'home' : $array_uri[1];
	$method_name = empty($array_uri[2]) ? 'index' : $array_uri[2];

	$controller_path = APP.'controllers/'.$controller_name.'Controller'.EXT;
	if(file_exists($controller_path))
	{
	    include $controller_path;
	    
	    $page = new $controller_name();

	    if(method_exists($page, $method_name))
	    {
		$page->$method_name();
	    }else
	    {
		$this->output->error_404();
	    }
	}else
	{
	    $this->output->error_404();
	}
	$this->output->display();
    }
}*/
$GLOBALS['config'] = require_once BASE.'config/main'.EXT;

require_once CORE.'session'.EXT;
$session = new session();

require_once  CORE.'cache'.EXT;
$cache = new cache();

require_once CORE.'output'.EXT;
$output = new output();

require_once CORE.'controller'.EXT;
require_once CORE.'model'.EXT;

require_once CORE.'uri'.EXT;
$uri = new uri();

$array_uri = $uri->getArrayUri();
$controller = $array_uri[1] === '' ? 'home' : $array_uri[1];
$method = empty($array_uri[2]) ? 'index' : $array_uri[2];

$controller_path = APP.'controllers/'.str_replace('.', '/', $controller).'Controller'.EXT;
if(file_exists($controller_path))
{
    include $controller_path;

    $controller_array = explode('.', $controller);
    $controller_name = end($controller_array);
    unset($controller_array);
    $page = new $controller_name;

    if(method_exists($page, $method))
    {
        $page->$method();
    }else
    {
        $output->error_404();
    }
}else
{
    $output->error_404();
}
$output->display();