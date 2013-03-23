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
        $model =& $this->loader->loadModel('user');

        if($model->accountExists($this->account->value())){
            return array(
                'alert_msg'=>'Le nom de compte est déjà pris !',
                'account'=>'Nom de compte indisponible !'
            );
        }

        if($model->pseudoExists($this->pseudo->value())){
            return array(
                'alert_msg'=>'Le pseudo est déjà utilisé !',
                'pseudo'=>'Pseudo indisponible !'
            );
        }
    }

    public function labels(){
        return array(
            'account'=>'Nom de compte',
            'pseudo'=>'Pseudo',
            'pass1'=>'Mot de passe',
            'pass2'=>'Confirmation',
            'email'=>'E-mail'
        );
    }
}
