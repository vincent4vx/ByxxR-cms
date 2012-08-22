<?php
class InputInput extends AbstractInput
{
    public function __construct($name, &$parent, $attributes, $functions, $label)
    {
	parent::__construct($name, $parent, $attributes, $functions, $label);
    }
    
    protected function setPattern()
    {
	if($this->pattern!=='')
	{
	    $pattern='';
	    if(!isset($this->attributes['type']))
		return;
	    switch ($this->attributes['type'])
	    {
		case 'text': break;
		case 'email': 
		    $pattern = '#[a-z0-9\._-]+@[a-z0-9/\._-]+\.[a-z]{2,4}#i';
		    break;
		case 'number':
		    $pattern = '#[0-9]+(\.[0-9]+)?#';
		    break;
		case 'tel':
		    $pattern = '#(\+[0-9]{3}|0)[1-9](.| )?([0-9]{2}){4}#';
		    break;
		case 'date':
		    $pattern = '#[0-9]{4}-[0-1][0-9]-[0-3][0-9]#';
		    break;
		case 'mounth':
		    $pattern = '#[0-9]{4}-[0-1][0-9]#';
		    break;
		case 'url':
		    $pattern = '#(http://|https://)[a-z0-9/%\.+_-]+\.[a-z]{2,4}(/[a-z0-9/%\.+_-]*)?#i';
		    break;
		case 'week':
		    $pattern = '#[0-9]{4}-W[0-9]{2}#';
		    break;
	    }
	    $this->pattern=$pattern;
	}
    }
    
    public function __toString()
    {
	$output='<input ';
	foreach($this->attributes as $name=>$value)
	    $output.=$name.'="'.$value.'" ';
	$output.='name="'.$this->name.'" />';
	return $output;
    }
}
