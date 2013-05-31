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

    public static function redirect($route = '', $time = 0, $external = false){
        if($external)
            $url = $route;
        else
            $url = self::genUrl($route);

        if(!headers_sent() && $time===0){
            header('location: '.$url);
            return;
        }

        echo '<meta http-equiv="refresh" content="'.$time.';url: '.$url.'"/>';
    }

    public static function forum($route = '', $encode = true){
        if(is_array($route)){
            if($encode)
                $route = array_map('urlencode', $route);
            $route = implode('/', $route);
        }

        if(($url = Core::conf('forum.forum_url')))
            return $url.$route;
        return self::genUrl('forum/'.$route);
    }

    public static function forumList(array $path, $encode = true){
        array_unshift($path, 'list');
        return self::forum($path, $encode);
    }

    public static function forumThread(array $path, $encode = true){
        array_unshift($path, 'thread');
        return self::forum($path, $encode);
    }
}
