<?php
class UserController extends Controller{
    public function registerAction(){     
        $form =& $this->loader->loadForm('register');
        $this->output->view('user/register', array('form'=>$form));
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
