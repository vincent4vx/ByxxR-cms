<?php
/*
 * gestion des uri
 */
class uri
{
    protected $string_uri;
    protected $array_uri;
    
    public function __construct() 
    {
        if(empty($_SERVER['PATH_INFO']))
        {
            $this->string_uri = '/';
        }else
        {
            $this->string_uri = $_SERVER['PATH_INFO'];
        }
        $this->array_uri = explode('/', $this->string_uri);
    }
    
    public function getStringUri()
    {
        return $this->string_uri;
    }
    
    public function getArrayUri()
    {
        return $this->array_uri;
    }
}