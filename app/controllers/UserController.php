<?php
class UserController extends Controller{
    public function registerAction(){
        if($this->session->isLog()){
            $this->session->setFlashMsg('Vous ne pouvez pas accéder à cette page !', 'NO');
            return Url::redirect();
        }

        $ip = $_SERVER['REMOTE_ADDR'];

        $key = 'data.'.str_replace('.', '_', $ip).'.cannot_register';
        $can_register = $this->cache->get($key);

        if($can_register === null){
            $can_register = $this->model('user')->canRegister($ip);
            $this->cache->set($key, $can_register, 600);
        }

        if($can_register === false){
            $this->session->setFlashMsg("Vous vous êtes déjà inscrit il y a moins de {$this->config['user']['inter_register_attemps']} heures, ou vous avez créé plus de <b>{$this->config['user']['per_ip']}</b> comptes.<br/>Vous ne pouvez donc pas vous inscrire pour le moment !", 'NO');
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
        $ip = $_SERVER['REMOTE_ADDR'];
        $banip = $this->cache->get('data.'.str_replace('.', '_', $ip).'.banip');

        if($banip === null){
            $banip = $this->model('user')->isBanIp($ip);
            $this->cache->set('data.'.str_replace('.', '_', $ip).'.banip', $banip, 600);
        }

        if($banip === true){
            $this->session->setFlashMsg('Connexion impossible : votre IP a été bannie !', 'NO');
            Url::redirect();
            return;
        }

        if(!empty($_POST['login']) && !empty($_POST['passlog']) && !$this->session->isLog()){
            $data = $this->model('user')->loadForLogin($_POST['login'], $_POST['passlog']);
            if(!$data)
                $this->session->setFlashMsg('Erreur lors de la connexion : nom de compte ou mot de passe incorrect.', 'NO');
            elseif($data['banned'] == 1)
                $this->session->setFlashMsg('Connexion impossible : votre compte est banni !', 'NO');
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

    public function userAction($id = 0){
        $id = (int)$id;
    }

    public function indexAction(){
        if(!$this->session->isLog()){
            $this->session->setFlashMsg('Veuillez vous connecter pour voir cette page...', 'NO');
            return Url::redirect();
        }

        if(($account = $this->cache->get('data.account.'.$this->session->guid))===null){
            $account=$this->model('user')->loadAccount($this->session->guid);
            $this->cache->set('data.account.'.$this->session->guid, $account, $this->config['cache']['profil']);
        }

        $this->output->view('user/profile', array(
            'account'=>$account
        ));
    }

    public function actionAction($action = ''){
        $this->output->layout = 'layouts/ua_layout';
        $allowed = array('delete', 'changemail');

        if(!in_array($action, $allowed) || !$this->session->isLog())
            exit('<div style="text-align: center;color:red;">Cette action n\'est pas permise !</div>');

        if(($account = $this->cache->get('data.account.'.$this->session->guid))===null){
            $account=$this->model('user')->loadAccount($this->session->guid);
            $this->cache->set('data.account.'.$this->session->guid, $account, $this->config['cache']['profil']);
        }

        $form = $this->loader->loadForm('Ua'.ucfirst($action));

        $this->output->view('user/action/'.$action, array(
            'account'=>$account,
            'form'=>$form
        ));
    }
}
