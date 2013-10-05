<?php
class BException extends Exception{
    private $title = 'An Exception was encountered';
    /**
     * create a new exception
     * @param string $message
     * @param array $args
     */
    public function __construct($message, $title = '') {
        parent::__construct($message);
        
        if(!empty($title))
            $this->title = $title;
    }

    public function __toString() {
        ob_start();
        require __DIR__.'/views/exception_layout.php';
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}
