<?php
abstract class AbstractInput
{ 
    protected $_parent;
    protected $label='';
    protected $name='';
    protected $id='';
    protected $validate_functions=array();
    protected $pattern='';
    protected $attributes;

    public function __construct($name, &$parent, &$attributes, &$functions, &$label)
    {
	$this->name=$name;
	$this->_parent=&$parent;
	$this->setAttributes($attributes);
	$this->validate_functions=&$functions;
	$this->setLabel($label);
	$this->setPattern();
    }

    protected function setAttributes(array &$attributes)
    {	    
	if(isset($attributes['pattern']))
	    $this->pattern='#'.$value.'#';
	if(in_array('required', $attributes))
	    $attributes['required']='required';
	$this->attributes=&$attributes;
    }
    
    protected final function setLabel(&$label)
    {
	if($label===false)
	    $this->label='';
	else
	    $this->label=&$label;
    }
    
    protected final function setId()
    {
	if(isset($this->attributes['id']))
	    $this->id=$this->attributes['id'];
	else
	    $this->id=$this->name;
    }

    protected abstract function setPattern();
    
    public function label()
    {
	return '<label for="'.$this->id.'">'.$this->label.'</label>';
    }
}
