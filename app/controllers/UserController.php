<?php
class UserController extends Controller{
    public function registerAction(){
        $form =& $this->loader->loadForm('register');

        $this->output->add(Assets::js('form'));

        $this->output->view('user/register', array('form'=>$form));
    }
}
