<?php
class RegisterForm extends Form{
    /**
     * @var AbstractInput
     */
    public $account, $pseudo, $pass1, $pass2, $email, $answer, $response;

    public function url(){
        return Url::genUrl();
    }

    public function rows(){
        return array(
            'account'=>array('text', array('required', 'pattern'=>'[a-zA-Z0-9\._-]{4,12}'), 'diff(pseudo)'),
            'pseudo'=>array('text', array('required', 'pattern'=>'[a-zA-Z0-9\._-]{4,12}'), 'diff(account)'),
            'pass1'=>array('password', array('required', 'pattern'=>'.{4,32}')),
            'pass2'=>array('password', array('required'), 'equal(pass1)'),
            'email'=>array('email', array('required')),
            'answer'=>array('text', array('required')),
            'response'=>array('text', array('required'))
        );
    }

    protected function onFormValid() {
        if(!isset($_COOKIE['byxxr_register_token'])){
            $this->session->setFlashMsg('Protection anti-bot : Veuillez accepter le cookies pour pouvoir vous inscrire !', 'NO');
            return false;
        }

        if($_COOKIE['byxxr_register_token'] !== $this->session->register_token){
            $this->session->setFlashMsg('Protection anti-bot : le token est invalide !', 'NO');
            return false;
        }

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

        $model->createAccount(
            $this->account->value(),
            $this->pseudo->value(),
            $this->pass1->value(),
            $this->email->value(),
            $this->answer->value(),
            $this->response->value()
        );

        $this->session->setFlashMsg('Compte créé avec succès.<br/>Vous pouvez maintenant vous connecter !', 'OK');
        return true;
    }

    public function labels(){
        return array(
            'account'=>'Nom de compte',
            'pseudo'=>'Pseudo',
            'pass1'=>'Mot de passe',
            'pass2'=>'Confirmation',
            'email'=>'E-mail',
            'answer'=>'Question secrète',
            'response'=>'Réponse'
        );
    }
}
