<?php
abstract class Form
{
    public abstract function rows();
    public abstract function url();

    public function __construct() {
        require_once __DIR__.'/inputs/AbstractInput'.EXT;
        foreach($this->rows() as $row_name=>$row_data){
            $class = ucfirst($row_data[0]).'Input';
            
            require_once __DIR__.'/inputs/'.$class.EXT;

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

    /**
     * Get all the script of rows
     * @return string
     */
    public function getScript(){
        $script = '';
        foreach(array_keys($this->rows()) as $row){
            $script.=$this->{$row}->getScript().PHP_EOL;
        }

        return $script;
    }

    protected abstract function onFormValid();
}
