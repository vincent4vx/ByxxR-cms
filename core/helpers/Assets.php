<?php
class Assets
{    
    public static function css($file)
    {
	return '<link href="'.Core::conf('root').'public/css/'.$file.'.css" rel="stylesheet" type="text/css" />';
    }
    
    public static function img($file, array $attributes = array())
    {
        $attr = Core::conf('use_localstorage') ? 'url' : 'src';
        $img = '<img '.$attr.'="'.Core::conf('root').'public/images/'.$file.'" alt="image"';
        foreach($attributes as $name=>$value){
            $img.=' '.$name.'="'.$value.'"';
        }
        $img .= ' />';
        return $img;
    }
    
    public static function js($files)
    {
        $return = '';
        $files = (array)$files;
        foreach($files as $file)
            $return .= '<script src="'.Core::conf('root').'public/js/'.$file.'.js" type="text/javascript"></script>';

        return $return;
    }
    
    public static function link($title, $controller = '', $method = '', $vars=array(), $class = '')
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
