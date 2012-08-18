<?php
class Url
{
    protected $base_url;
    protected $rewrite;
    
    public function __construct()
    {
	$this->base_url=Core::$config['root'];
	$this->rewrite=Core::$config['rewrite'];
    }
    
    public function genUrl($controller='', $method='', $vars=array())
    {
	$url = $this->base_url;
        if(!$this->rewrite)
        {
            $url .= 'index.php/';
        }
        $url .= $controller;
        if($method !== '')
        {
            $url .= '/'.$method;
        }
	if(!empty($vars))
	{
	    if(is_array($vars))
		$url.='/'.implode('/', $vars);
	    else
		$url.='/'.$vars;
	}
        return $url;
    }
    
    public function link($title, $controller = '', $method = '', $vars=array(), $class = '')
    {
        $url=$this->genUrl($controller, $method, $vars);
	return $this->linkByUrl($title, $url, $class);
    }
    
    public function linkByUrl($title, $url, $class='')
    {
        $link =  '<a href="'.$url.'"';
        if($class !== '')
        {
            $link .= ' class="'.$class.'"';
        }
        $link .= '>'.$title.'</a>';
        return $link;	
    }
}
