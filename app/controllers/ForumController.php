<?php
class ForumController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->output->titleImg = 'forum';
        if(!$this->config['forum']['integrated_forum']){
            $this->output->error_404();
            exit;
        }
    }
    
    public function indexAction(){
        $this->output->view('forum/index', array(
            'categories' => $this->model('forums')->getCategoriesList()
        ));
    }

    public function listAction(){
        $path = func_get_args();
        $data = $this->model('forums')->loadByPath($path);
        $this->output->view('forum/list', $data + array('current'=>$path));
    }

    public function newThreadAction($forum_id = 0){
        if(empty($_POST['title']) || trim($_POST['title']) === '' || empty($_POST['content']) || trim($_POST['content']) === '')
            return $this->output->view('forum/newthread');

        $path = $this->model('threads')->create(
                (int)$forum_id,
                trim($_POST['title']),
                $this->session->guid,
                trim($_POST['content'])
        );
        $this->session->setFlashMsg("Le sujet <b>{$_POST['title']}</b> à bien été créé !");
        return Url::redirect(Url::forumThread($path), true);
    }
}
