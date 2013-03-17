<?php
class BException extends Exception{
    /**
     * create a new exception
     * @param string $message
     * @param array $args
     */
    public function __construct($message, array $args) {
        $message = I18n::tr($message, 'errors', $args);
        parent::__construct($message);
    }

    public function __toString() {
        $message = $this->message;
        $title = 'An Exception was encountered';

        ob_start();
        require __DIR__.'/views/exception_layout.php';
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}
