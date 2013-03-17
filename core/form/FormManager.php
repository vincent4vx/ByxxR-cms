<?php
class FormManager
{
    protected $empty=true;
    protected $_form;


    public function __get($name) {
	if($this->empty)
	    return false;
	return $this->_form->$name;
    }
    
    public function __construct()
    {
	//charge les compasentes essentiels
	require_once 'inputs/AbstractInput'.EXT;
	require_once 'Form'.EXT;
    }


    public function load($form)
    {
	if(!$this->empty)
	    throw new Exception('FormManager have already load a form !');
	$class_name=ucfirst($form).'Form';
	require_once APP.'forms/'.$class_name.EXT;
	$this->_form=new $class_name;
	$this->loadFormValue();
	$this->empty=false;
    }
    
    protected function loadFormValue()
    {
	$labels=$this->_form->labels();
	
	foreach($this->_form->rows() as $row=>$data)
	{
	    $class_name=ucfirst($data[0]).'Input';
	    $attributes=isset($data[1])?$data[1]:array();
	    $functions=isset($data[2])?$data[2]:array();
	    $label=isset($labels[$row])?$labels[$row]:false;
	    $inter_rows=isset($data[3])?$data[3]:false;
	    
	    require_once 'inputs/'.$class_name.EXT;
	    $this->_form->$row=new $class_name($row, $this->_form, $attributes, $functions, $label, $inter_rows);
	}
    }
    
    public function submit($value='Ok')
    {
	return '<input type="submit" name="submit" id="submit" value="'.$value.'" />';
    }
    
    public function open()
    {	
	return '<form action="'.$this->_form->url().'" onsubmit="return validateForm(\''.$this->_form->url().'\', this)">';
    }
    
    public function close()
    {
	return '</form>';
    }
    
    public function getScript()
    {
	$script='<script type="text/javascript">'.PHP_EOL.'//<![CDATA[';
	foreach($this->_form as $row)
	    $script.=$row->getScript().PHP_EOL;
	$script.='//]]>'.PHP_EOL.'</script>';
	
	return $script;
    }
    
    public function validate()
    {
	$errors=array();
	foreach($this->_form as $row)
	{
	    $error=$row->validate();
	    if($error!==true)
		$errors+=$error;
	}
	
	if($errors===array())
	    return true;
	return $errors;
    }
}
