<?php
class SQLException extends BException{
    public function __construct($message, $query) {
        if(empty($query))
            $query = 'none';
        
        $message = '<h2>Message : </h2>'.$message.'<h2>Query :</h2>'.$query;
        parent::__construct($message, 'Database error');
    }
}
