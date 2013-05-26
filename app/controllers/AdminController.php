<?php
class AdminController extends Controller{
    public function newsAction($action = 'list', $param = null){
        if(!$this->session->handle_news){
            $this->session->setFlashMsg("Vous n'avez pas les droits nécessaires pour voire cette page <em>(handle_news)</em>", 'NO');
            Url::redirect();
            return;
        }

        if($action === 'list'){
            $this->output->view('admin/news', array(
                'news' => $this->model('news')->getList()
            ));
        }elseif($action === 'create'){
            if(!$this->createNew()){
                $this->session->setFlashMsg("Erreur lors de l'envoi de la nouvelle !", 'NO');
                Url::redirect('admin/news');
                return;
            }
        }
    }

    private function createNew(){
        if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['type']))
            return false;

        $this->model('news')->create(
                $_POST['type'],
                $_POST['title'],
                $_POST['content'],
                $this->session->pseudo
        );
        $this->session->setFlashMsg('La nouvelle a été posté avec succès !');
        $this->cache->delete('pages.news');
        Url::redirect('admin/news');
        return true;
    }
}
