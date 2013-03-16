<?php
class ErrorHandler{
    /**
     * initialize the errors handler
     */
    public static function init(){
        require_once __DIR__.'/BException'.EXT;
        require_once __DIR__.'/SQLException'.EXT;
        require_once __DIR__.'/LoaderException'.EXT;

        set_error_handler(function($errno, $errstr, $errfile = '', $errline = 0){
            echo self::error500($errfile, $errline);
        });
    }

    public static function error($msg, $file, $line, $code = 200, $name = 'User error'){
        header('HTTP/1.0 '.$code);

        ob_start();
        require_once __DIR__.'/views/error.php';
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    /**
     * display an internal server error
     * @param string $file
     * @param int $line
     */
    public static function error500($file, $line){
        return self::error('error500_msg', $file, $line, 500, 'Internal server error');
    }
}
