<?php
class UaDeleteForm extends Form{
    public $pass, $response;

    public function rows() {
        return array(
            'pass'=>array('password', array('required', 'pattern'=>'.{4,32}')),
            'response'=>array('text', array('required'))
        );
    }

    protected function onFormValid() {
        if(!$this->session->isLog())
            return array('alert_msg'=>'Vous êtes déconnecté !');
        
        if(($account = $this->cache->get('data.account.'.$this->session->guid))===null){
            $account=$this->model('user')->loadAccount($this->session->guid);
            $this->cache->set('data.account.'.$this->session->guid, $account, $this->config['cache']['profil']);
        }
        
        $err = array();
        if($account['pass'] !== $this->pass->value())
            $err['pass']='Le mot de passe ne correspond pas !';

        if($account['reponse'] !== $this->response->value())
            $err['response']='Mauvaise réponse !';

        if($err !== array())
            return $err;

        $this->loader->loadModel('user')->delete($account['guid']);
        $this->session->destroy();
        $this->session->setFlashMsg('Votre compte a bien été supprimé avec succès !');
        return true;
    }

    public function url() {
        return Url::genUrl();
    }
}
