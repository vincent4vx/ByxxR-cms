<?php
class UserController extends Controller{
    public function registerAction(){     
        $form =& $this->loader->loadForm('register');
        $this->output->view('user/register', array('form'=>$form));
    }

    public function loginAction(){
        if(!empty($_POST['login']) && !empty($_POST['passlog'])){
            $data = $this->model('user')->loadForLogin($_POST['login'], $_POST['passlog']);
            $this->session->login($data);
        }

        if(isset($_GET['url']))
            Url::redirect(urldecode($_GET['url']), 0, true);
        else
            Url::redirect();
    }

    public function logoutAction(){
        $this->session->destroy();
        Url::redirect();
    }
}
