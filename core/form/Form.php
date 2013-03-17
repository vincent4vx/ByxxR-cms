<?php
abstract class Form
{
    public abstract function rows();
    public abstract function url();

    public function __construct() {
        foreach($this->rows() as $row_name=>$row_data){
            $class = ucfirst($row_data[0]).'Input';

            if(!class_exists($class)){
                require_once __DIR__.'/inputs/'.$class.EXT;
            }

            $this->$row_name = new $class(
                        $this,
                        $row_name,
                        isset($row_data[1]) ? $row_data[1] : array(),
                        isset($row_data[2]) ? $row_data[2] : ''
            );
        }
    }

    public function labels()
    {
	return array();
    }

    public function validate(){
        return $this->onFormValid();
    }

    protected abstract function onFormValid();
}