<?php
class ErrorHandler{
    /**
     * initialize the error handler
     */
    public static function init(){
        require __DIR__.'/BException'.EXT;
        require __DIR__.'/SQLException'.EXT;
        require __DIR__.'/LoaderException'.EXT;

        set_error_handler(function($errno, $errstr, $errfile = '', $errline = 0){
            if($errno === E_USER_ERROR || $errno === E_ERROR){
                if(DEBUG)
                    exit(self::error($errstr, $errfile, $errline, 500, 'Internal server error'));
                else
                    exit(self::error500 ($errfile, $errline));
            }elseif(DEBUG){
                switch($errno){
                    case E_NOTICE:
                    case E_USER_NOTICE:
                        $name = 'Notice';
                        break;
                    case E_WARNING:
                    case E_USER_WARNING:
                        $name = 'Warning';
                        break;
                    case E_STRICT:
                        $name = 'Strict standard';
                        break;
                    default:
                        $name = 'Error';
                }
                Core::get_instance()->loader->get('Output')->add(self::error($errstr, $errfile, $errline, $errno, $name));
            }
        });

        set_exception_handler(function(Exception $e){
            if(DEBUG)
                exit($e);

            exit(self::error500($e->getFile(), $e->getLine()));
        });
    }

    public static function error($msg, $file, $line, $code = 200, $name = 'User error'){
        if(!headers_sent())
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
        return self::error('An internal error was encountered.<br/>If you\'re the webmaster, set DEBUG to true on <b>index.php</b> to see more details.', $file, $line, 500, 'Internal server error');
    }
}
