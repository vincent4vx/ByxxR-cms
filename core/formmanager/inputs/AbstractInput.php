<?php
abstract class AbstractInput
{ 
    protected $_parent;
    public $label='';
    protected $name='';
    public $id='';
    protected $validate_functions=array();
    protected $pattern='';
    protected $inter_rows;
    protected $attributes;

    public function __construct($name, &$parent, &$attributes, &$functions, &$label, $inter_rows)
    {
	$this->name=$name;
	$this->_parent=&$parent;
	$this->setAttributes($attributes);
	$this->validate_functions=&$functions;
	$this->inter_rows = $inter_rows;
	$this->setLabel($label);
	$this->setPattern();
	$this->setId();
    }

    protected function setAttributes(array &$attributes)
    {	    
	if(isset($attributes['pattern']))
	    $this->pattern=$value;
	foreach($attributes as $attribute=>$value)
	{
	    if(is_numeric($attribute))
	    {
		$attributes[$value]=$value;
		unset($attributes[$attribute]);
	    }
	}
	/*if(in_array('required', $attributes))
	    $attributes['required']='required';*/
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
    
    public function value()
    {
	if(!empty($_POST[$this->name]))
	    return $_POST[$this->name];
	return '';
    }

    protected abstract function setPattern();
    
    public final function label()
    {
	return '<label for="'.$this->id.'">'.$this->label.'</label>';
    }
    
    public final function error()
    {
	return '<div id="'.$this->id.'Error" class="formError" style="display: inline-block"></div>';
    }
    
    public function validate()
    {
	if(isset($this->attributes['required']) and $this->value()==='')
	    return array($this->name=>'Ce champ est obligatoire !');
	
	if($this->value() !== '' and $this->pattern !== '' and !preg_match($this->pattern, $this->value()))
	    return array($this->name=>'Champ invalide !');
	
	foreach($this->validate_functions as $function)
	{
	    $error=$this->_parent->$function($this);
	    if($error!==true)
		return $error;
	}    
    }
    
    private function validate_inter_rows($script=false)
    {
	if(!$this->inter_rows)
	    return true;
	
	$param=array();
	if(!preg_match('#(equal|diff)\(([a-z0-9]+)\)#i', $this->inter_rows, $param))
	    exit('Syntaxe error in inter_rows function declaration for '.$this->name);
	if($param[1]==='equal')
	{
	    if(!$script)
		return $this->value() === $this->_parent->$param[2]->value();
	    
	    return '
		if(elem.value != document.getElementById("'.$this->_parent->$param[2]->id.'").value)
		{
		    display_form_error(id, "Ce champ doit être de la même valeur que '.$this->_parent->$param[2]->label.'");
		    return;
		}'.PHP_EOL;
	}elseif($param[1]==='diff')
	{
	   if(!$script)
		return $this->value() !== $this->_parent->$param[2]->value();
	    
	    return '
		if(elem.value == document.getElementById("'.$this->_parent->$param[2]->id.'").value)
		{
		    display_form_error(id, "Ce champ doit être différent de '.$this->_parent->$param[2]->label.'");
		    return;
		}'.PHP_EOL; 
	}else
	    return true;
    }


    public function getScript()
    {
	$script='
	    function validate'.$this->name.'()
	    {
		var id = "'.$this->id.'";
		var elem = document.getElementById(id);
	    '.($this->inter_rows===false?'':$this->validate_inter_rows(true)).'
	    '.(!isset($this->attributes['required'])?'':'
		if(elem.value == "")
		{
		    display_form_error(id, "Ce champ est obligatoire !");
		    return;
		}').'
	    '.($this->pattern===''?'':'
		var regex = new RegExp("'.str_replace('\\', '\\\\', $this->pattern).'");
		if(!regex.test(elem.value) && elem.value!="")
		{
		    display_form_error(id, "Champ invalide !");
		    return;
		}').'
		form_valid(id);
	    }'.PHP_EOL;
	
	return $script;
    }
}
