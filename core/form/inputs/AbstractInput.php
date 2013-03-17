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
    protected $attributes = array();

    /**
     * The parrent form
     * @var Form
     */
    protected $_form;
    /**
     * The validate function
     * @var array
     */
    protected $function;
    /**
     * If is required
     * @var bool
     */
    protected $required = false;

    /*public function __construct($name, &$parent, &$attributes, &$functions, &$label, $inter_rows)
    {
	$this->name=$name;
	$this->_parent=&$parent;
	$this->setAttributes($attributes);
	$this->validate_functions=&$functions;
	$this->inter_rows = $inter_rows;
	$this->setLabel($label);
	$this->setPattern();
	$this->setId();
    }*/

    public function __construct(Form &$form, $name, array $attributes = array(), $function = '') {
        $this->_form =& $form;
        $this->name = $name;
        $this->setAttributes($attributes);
        $this->function = $function;
        $this->setPattern();
    }

    public abstract function __toString();

    protected function setAttributes(array &$attributes)
    {	    
	if(isset($attributes['pattern']))
	    $this->pattern=$attributes['pattern'];
        if(in_array('required', $attributes))
            $this->required=true;
	foreach($attributes as $attribute=>$value)
	{
	    if(is_numeric($attribute))
	    {
		$attributes[$value]=$value;
		unset($attributes[$attribute]);
	    }
	}
	$this->attributes=&$attributes;
    }
    
    protected final function setLabel(&$label)
    {
	if($label===false)
	    $this->label='';
	else
	    $this->label=&$label;
    }
    
    public function value()
    {
	if(!empty($_POST[$this->name]))
	    return $_POST[$this->name];
	return '';
    }

    protected final function setPattern(){
        if($this->pattern === ''){
            $this->pattern = $this->defaultPattern();
        }
    }
    protected abstract function defaultPattern();
    
    public final function label()
    {
	return HForm::label($this);
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
