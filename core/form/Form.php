<?php
abstract class Form
{
    public abstract function rows();
    public abstract function url();

    public function __construct() {
        Core::get_instance()->loader->addIncludePath(__DIR__.'/inputs/');
        
        foreach($this->rows() as $row_name=>$row_data){
            $class = ucfirst($row_data[0]).'Input';

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
        $errors = array();
        foreach($this->rows() as $row=>$x){
            $err = $this->{$row}->validate();
            if($err!==true){
                $errors+=$err;
            }
        }

        if($errors!==array())
            return $errors;
        
        return $this->onFormValid();
    }

    /**
     * Get all the script of rows
     * @return string
     */
    public function getScript(){
        $script = '';
        foreach($this->rows() as $row=>$x){
            $script.=$this->{$row}->getScript().PHP_EOL;
        }

        return $script;
    }

    protected abstract function onFormValid();
}
