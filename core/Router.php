<?php
/*
 * gestion des uri
 * et chargement de la page
 */
class Router
{
    public $string_uri='';
    public $array_uri=array();
    public $controller='Home';
    public $method='index';
    public $vars=array();
    
    public function __construct() 
    {
        if(empty($_SERVER['PATH_INFO']))
        {
            $this->string_uri = '';
        }else
        {
            $this->string_uri = substr($_SERVER['PATH_INFO'],1);
        }
        $this->array_uri = explode('/', $this->string_uri);
	
	if(!empty($this->array_uri[0]))
	    $this->controller=ucfirst(strtolower($this->array_uri[0]));
	if(!empty($this->array_uri[1]))
	    $this->method=strtolower($this->array_uri[1]);
	if(count($this->array_uri)>2)
	    $this->vars=array_slice($this->array_uri, 2);
    }
    
    public function load_page()
    {
	if(!is_object($obj=&Loader::getClass($this->controller.'Controller', APP.'controllers/')))
	    return $obj;
	return @call_user_func_array(array($obj, $this->method.'Action'), $this->vars);
    }
}