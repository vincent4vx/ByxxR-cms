<?php
class TestForm extends Form
{
    public $text;
    public $email;
    public $url;
    
    public function url()
    {
	return Loader::getClass('Url')->genUrl('test', 'validate');
    }

    public function rows()
    {
	return array(
	    'text'=>array('input', array('required')),
	    'email'=>array('input', array('type'=>'email', 'required')),
	    'url'=>array('input', array('type'=>'url'))
	);
    }
    
    public function labels()
    {
	return array(
	    'text'=>'Un input text simple',
	    'email'=>'Un input d\'email (html5)',
	    'url'=>'Votre site'
	);
    }
}
