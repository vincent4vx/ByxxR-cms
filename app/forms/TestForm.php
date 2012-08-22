<?php
class TestForm extends Form
{
    public $text;
    public $email;
    
    public function rows()
    {
	return array(
	    'text'=>array('input', array('required')),
	    'email'=>array('input', array('type'=>'email'))
	);
    }
    
    public function labels()
    {
	return array(
	    'text'=>'Un input text simple',
	    'email'=>'Un input d\'email (html5)'
	);
    }
}
