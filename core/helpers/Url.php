<?php
class Url
{    
    public static function genUrl($controller='', $method='', $vars=array())
    {
	$url = Core::conf('root');
        if(!Core::conf('rewrite'))
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
    
    public static function link($title, $controller = '', $method = '', $vars=array(), $class = '')
    {
        $url=self::genUrl($controller, $method, $vars);
	return self::linkByUrl($title, $url, $class);
    }
    
    public static function linkByUrl($title, $url, $class='')
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
