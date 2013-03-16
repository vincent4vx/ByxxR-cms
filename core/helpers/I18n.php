<?php
class I18n{
    /**
     * all the lang data
     * @var array
     */
    private static $lang_data = array();

    /**
     * Translate  text
     * @param string $text
     * @param string $file
     * @param mixed $args
     * @return string
     */
    public static function tr($text, $file, $args = null){
        if($args === null)
            $args = array();
        
        if(!is_array($args)){
            $args = func_get_args();
            $args = array_slice($args, 2);
        }

        $lang = Core::get_instance()->config['lang'];
        $path = BASE.'lang/'.$lang.'/'.$file.EXT;

        if(!isset(self::$lang_data[$file])){
            if(!file_exists($path))
                throw new BException('i18n_error', array($file, $text));

            self::$lang_data[$file] = include $path;
        }

        $text = isset(self::$lang_data[$file][$text]) ? self::$lang_data[$file][$text] : $text;
        array_unshift($args, $text);

        return call_user_func_array('sprintf', $args);
    }
}
