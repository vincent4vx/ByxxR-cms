<?php
class Mimes{
    public static function ext2mime($ext){
        $arr = array(
            '.html' => 'text/html',
            '.json' => 'text/json'
        );
        
        if(isset($arr[$ext]))
            return $arr[$ext];
        
        return 'text/plain';
    }
}
