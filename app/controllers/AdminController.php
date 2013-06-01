<?php
class AdminController extends Controller{
    public function newsAction($action = 'list', $param = null){
        if(!$this->session->handle_news){
            $this->session->setFlashMsg("Vous n'avez pas les droits nécessaires pour voire cette page <em>(handle_news)</em>", 'NO');
            Url::redirect();
            return;
        }

        if($action === 'list'){
            $this->output->view('admin/news/list', array(
                'news' => $this->model('news')->getList()
            ));
        }elseif($action === 'create'){
            if(!$this->createNew()){
                $this->session->setFlashMsg("Erreur lors de l'envoi de la nouvelle !", 'NO');
                Url::redirect('admin/news');
                return;
            }
        }elseif($action === 'edit'){
            $this->editNew($param);
            return;
        }elseif($action === 'delete'){
            return $this->deleteNew($param);
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
        $this->cache->delete('pages.news.*');
        Url::redirect('admin/news');
        return true;
    }

    private function editNew($id){
        if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['type'])){
            $data = $this->model('news')->getById($id);
            if(!$data){
                $this->session->setFlashMsg('La nouvelle n°'.$id.' n\'existe pas !', 'NO');
                return Url::redirect('admin/news');
            }
            return $this->output->view('admin/news/edit', $data);
        }
        $this->model('news')->update(
                $id,
                $_POST['title'],
                $_POST['type'],
                $_POST['content']
        );
        $this->cache->delete('pages.news.*');
        $this->session->setFlashMsg('La nouvelle n°'.$id.' a bien été mise à jour !');
        Url::redirect('admin/news');   
    }

    private function deleteNew($id){
        $this->model('news')->delete($id);
        $this->cache->delete('pages.news.*');
        $this->session->setFlashMsg('La nouvelle a bien été supprimé !');
        Url::redirect('admin/news');
    }
}
