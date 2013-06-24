<?php
class UaChangemailForm extends Form{
    public $pass, $email;

    public function rows() {
        return array(
            'pass'=>array('password', array('required', 'pattern'=>'.{4,32}')),
            'email'=>array('email', array('required'))
        );
    }

    public function url() {
        return Url::genUrl('user');
    }

    protected function onFormValid() {
        if(!$this->session->isLog())
            return array('alert_msg'=>'Vous êtes déconnecté !');

        if(($account = $this->cache->get('data.account.'.$this->session->guid))===null){
            $account=$this->model('user')->loadAccount($this->session->guid);
        }

        if($this->pass->value() !== $account['pass'])
            return array('pass'=>'Mot de passe invalide !');

        $this->loader->loadModel('user')->updateColumn($this->session->guid, 'email', $this->email->value());
        $this->cache->delete('data.account.'.$this->session->guid);
        $this->session->email = $this->email->value();
        $this->session->setFlashMsg('Votre email a été modifié avec succès !');
        return true;
    }
}
