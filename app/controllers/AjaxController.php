<?php
class AjaxController extends Controller{
    public function validateformAction($name){
        if($this->output->getExt() !== '.json'){
            return $this->output->error_404();
        }
        
        $name = str_replace(array('.', '/'), '', $name);
        $form =& $this->loader->loadForm($name);
        echo json_encode($form->validate());
    }

    public function getChatMsgAction(){
        if($this->output->getExt() !== '.json'){
            return $this->output->error_404();
        }
        
        $return = $this->model('chat')->load();
        echo json_encode($return);
    }

    public function postChatMsgAction(){
        if(!$this->session->isLog() 
                || empty($_POST['content'])
                || trim($_POST['content']) === ''
                || empty($_POST['time'])
        )
            exit;

        if($_POST['content'] === '/clear' && $this->session->handle_chat){
            $this->model('chat')->clear();
            $this->ChatModel->add('La chatbox a été vidé !', '<span style="color: red;font-weight: bold;">Système</span>', time());
            return;
        }

        $this->model('chat')->add(
                trim($_POST['content']),
                $this->session->pseudo,
                $_POST['time']
        );
    }

    public function getPhoneByCountryAction($country){
        if($this->output->getExt() !== '.json'){
            return $this->output->error_404();
        }
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

        echo $data;
    }
    
    public function getPersosListAction(){
        if($this->output->getExt() !== '.json'){
            return $this->output->error_404();
        }
        
        if($this->output->startCache('persoslist.json')){
            echo json_encode($this->model('character')->getAll());
            $this->output->endCache(600);
        }
    }
}
