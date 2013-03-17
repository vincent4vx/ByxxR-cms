<?php
class RegisterForm extends Form{
    public $account;
    public $pseudo;
    public $pass1;
    public $pass2;
    public $email;

    public function url(){
        return Url::genUrl();
    }

    public function rows(){
        return array(
            'account'=>array('text', array('required', 'pattern'=>'[a-zA-Z0-9\._-]{4,12}'), 'diff(pseudo)'),
            'pseudo'=>array('text', array('required', 'pattern'=>'[a-zA-Z0-9\._-]{4,12}'), 'diff(account)'),
            'pass1'=>array('password', array('required', 'pattern'=>'.{4,32}')),
            'pass2'=>array('password', array('required'), 'equal(pass1)'),
            'email'=>array('email'),
        );
    }

    protected function onFormValid() {
        return true;
    }
}
