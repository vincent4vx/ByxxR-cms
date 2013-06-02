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

        $this->model('chat')->add(
                trim($_POST['content']),
                $this->session->pseudo,
                $_POST['time']
        );
    }

    public function getPhoneByCountryAction($country){
        if(strlen($country) !== 2)
            exit('erreur...');
        $url = 'http://script.starpass.fr/numero_pays_light.php?pays='.$country.'&id_document='.$this->config['points']['idd'].'&type=';

        if(($data = $this->cache->get('starpass.'.$country))===null){
            $data = '<b>Audiotel : </b>';
            $audio = file_get_contents($url.'audiotel');
            $data .= $audio === '' ? '<em>Indisponible...</em>' : $audio;
            $data .= '<br/><b>SMS : </b>';
            $sms = file_get_contents($url.'sms');
            $data .= $sms === '' ? '<em>Indisponible...</em>' : $sms;
            $this->cache->set('starpass.'.$country, $data, 3600*24);
        }

        exit($data);
    }
}
