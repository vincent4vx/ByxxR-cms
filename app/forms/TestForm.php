<?php
class TestForm extends Form
{
    public $text;
    public $email;
    public $url;
    public $txt2;
    
    public function url()
    {
	return Loader::getClass('Url')->genUrl('test', 'validate');
    }

    public function rows()
    {
	return array(
	    'text'=>array('input', array('required')),
	    'email'=>array('input', array('type'=>'email', 'required')),
	    'url'=>array('input', array('type'=>'url')),
	    'txt2'=>array('input', array('required', 'pattern'=>'^[a-zA-Z]+$'), array(), 'equal(text)'),
	);
    }
    
    public function labels()
    {
	return array(
	    'text'=>'Un input text simple',
	    'email'=>'Un input d\'email (html5)',
	    'url'=>'Votre site',
	    'txt2'=>'Retapper text',
	);
    }
}
