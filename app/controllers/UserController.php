<?php
class UserController extends Controller{
    public function registerAction(){
        $ip = $_SERVER['REMOTE_ADDR'];

        if($this->cache->get(str_replace('.', '_', $ip).'.cannot_register') === true){
            $this->session->setFlashMsg("Vous vous êtes déjà inscript il y a moins de {$this->config['user']['inter_register_attemps']} heures, ou vous avez dépassé la limite maximale autorisé autorisé de compte ({$this->config['user']['per_ip']}).<br/>Vous ne pouvez donc pas vous inscrire pour le moment !", 'NO');
            Url::redirect();
            return;
        }

        if(!$this->model('user')->canRegister($ip)){
            $this->cache->set(str_replace('.', '_', $ip).'.cannot_register', true);
            $this->session->setFlashMsg("Vous vous êtes déjà inscript il y a moins de {$this->config['user']['inter_register_attemps']} heures, ou vous avez dépassé la limite maximale autorisé autorisé de compte ({$this->config['user']['per_ip']}).<br/>Vous ne pouvez donc pas vous inscrire pour le moment !", 'NO');
            Url::redirect();
            return;
        }

        $token = Others::random_string();
        setcookie('byxxr_register_token', $token, time() + 600, '/');
        $this->session->register_token = $token;

        if($this->output->startCache('form.register_form')){
            $form =& $this->loader->loadForm('register');
            $this->output->view('user/register', array('form'=>$form));
            $this->output->endCache(24 * 3600);
        }
    }

    public function loginAction(){
        if(!empty($_POST['login']) && !empty($_POST['passlog']) && !$this->session->isLog()){
            $data = $this->model('user')->loadForLogin($_POST['login'], $_POST['passlog']);
            if(!$data)
                $this->session->setFlashMsg('Erreur lors de la connexion : nom de compte ou mot de passe incorrect.', 'NO');
            else{
                $this->session->login($data);
                $this->UserModel->setIp($data['guid'], $data['ip']);
                $this->session->setFlashMsg('Vous êtes maintenant connecté !');
            }
        }elseif($this->session->isLog())
            $this->session->setFlashMsg ('Vous êtes déjà connecté !', 'NO');

        if(isset($_GET['url']))
            Url::redirect(urldecode($_GET['url']), 0, true);
        else
            Url::redirect();
    }

    public function logoutAction(){
        $this->session->destroy();
        $this->session->setFlashMsg('Vous êtes déconnecté avec succès !');
        Url::redirect();
    }
}
