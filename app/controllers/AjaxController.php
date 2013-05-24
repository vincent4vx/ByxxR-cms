<?php
class AjaxController extends Controller{
    public function validateformAction($name){
        $name = str_replace(array('.', '/'), '', $name);
        $form =& $this->loader->loadForm($name);
        exit(json_encode($form->validate()));
    }

    public function getChatMsgAction(){
        $return = $this->model('chat')->load();
        exit(json_encode($return));
    }

    public function postChatMsgAction(){
        if(!$this->session->isLog() 
                || empty($_POST['content'])
                || trim($_POST['content']) === ''
                || empty($_POST['time'])
        )
            exit;

        $this->model('chat')->send(
                trim($_POST['content']),
                $this->session->pseudo,
                $_POST['time']
        );
    }

    public function chatAction(){
        $this->output->view('chat');
    }
}
