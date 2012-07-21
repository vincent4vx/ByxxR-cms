<?php
class Assets
{
    protected $base_url;
    
    public function __construct()
    {
	$this->base_url=Core::$config['root'];
    }
    
    public function css($file)
    {
	return '<link href="'.$this->base_url.'public/css/'.$file.'.css" rel="stylesheet" type="text/css" />';
    }
    
    public function img($file, $class = '')
    {
        $img = '<img src="'.$this->base_url.'public/images/'.$file.'"';
        if($class !== '')
        {
            $img .= ' class="'.$class.'"';
        }
        $img .= ' />';
        return $img;
    }
    
    public function js($file)
    {
        return '<script src="'.$this->base_url.'public/js/'.$file.'.js"></script>';
    }
    
    public function link($title, $controller = '', $method = '', $vars=array(), $class = '')
    {
        $link =  '<a href="'.$this->url($controller, $method, $vars).'"';
        if($class !== '')
        {
            $link .= ' class="'.$class.'"';
        }
        $link .= '>'.$title.'</a>';
        return $link;
    }
}
