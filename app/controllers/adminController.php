<?php
class admin extends controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function staff()
    {
        if($this->session->superAdmin())
        {
            $model = $this->model('maccount');
            $result = array();
            if(!empty($_GET['search']))
            {
                $result = $model->search($_GET['search']);
            }
            $this->output->view('admin/staff.html.twig', array(
                'staff' => $model->getStaff(false),
                'result' => $result
            ));
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function add()
    {
        if($this->session->superAdmin())
        {
            if(isset($_GET['id']) and is_numeric($_GET['id']))
            {
                $model = $this->model('maccount');
                $model->changeLevel($_GET['id'], 1);
                $this->output->success('img_admin', 'Membre recruté', 'Le membre a bien été recruté dans staff avec succès !<br/>Vous allez être redirigé vers la page de gestion du staff', 'admin', 'staff');
            }else
            {
                $this->output->error('img_admin', 'Mauvais argument', 'Le membre n\'a pas put être recruté, car l\'argument passé et incorrect.<br/>Vous allez être redirigé vers la page de gestion du staff.', 'admin', 'staff');
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function expulse()
    {
        if($this->session->superAdmin())
        {
            if(isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] != $this->config['admin']['super_admin'])
            {
                $model = $this->model('maccount');
                $model->changeLevel($_GET['id']);
                $this->output->success('img_admin', 'Membre renvoyé', 'Le membre a bien été renvoyé du staff avec succès !<br/>Vous allez être redirigé vers la page de gestion du staff', 'admin', 'staff');
            }else
            {
                $this->output->error('img_admin', 'Mauvais argument', 'Le membre n\'a pas put être renvoyé, car l\'argument passé et incorrect.<br/>Vous allez être redirigé vers la page de gestion du staff.', 'admin', 'staff');
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function changerank()
    {
        if($this->session->superAdmin())
        {
            if(isset($_POST))
            {
                $model = $this->model('maccount');
                foreach($_POST as $id => $value)
                {
                    if(is_numeric($id) and is_numeric($value))
                    {
                        $model->changeLevel($id, $value);
                    }else
                    {
                        continue;
                    }
                }
                $this->output->success('img_admin', 'Rang modifiés', 'Les rang des membres du staff ont été modifié avec succès !<br/>Vous allez être redirigé vers la page de gestion du staff.', 'admin', 'staff');
            }else
            {
                $this->output->error('img_admin', 'Mauvais argument', 'Le membre n\'a pas put être renvoyé, car l\'argument passé et incorrect.<br/>Vous allez être redirigé vers la page de gestion du staff.', 'admin', 'staff');
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function news()
    {
        if($this->session->isAdmin())
        {
            $newsModel = $this->model('news');
            $news = $newsModel->selectAll();
        
            $this->output->view('admin/news_admin.html.twig',array(
                    'news' => $news
                ));
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function delnew()
    {
        if($this->session->isAdmin())
        {
            if(isset($_GET['id']) AND is_numeric($_GET['id']))
            {
                $newsModel = $this->model('news');
                $newsModel->deletenew($_GET['id']);
                $this->output->success('img_admin','Suppresion d\'une nouvelle','Nouvelle supprimé avec succès !<br/>Vous allez être redirigé vers la page de gestion des news.', 'admin', 'news');
            }else
            {
                $this->output->error('img_admin','Erreur','Argument invalide, suppression impossible !<br/>Vous allez être redirigé vers la page de gestion des news.', 'admin', 'news');
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function addnew()
    {
        if($this->session->isAdmin())
        {
            if(empty($_POST['type']) OR empty($_POST['title']) OR empty($_POST['new']))
            {     
                $this->news();
            }else
            {
                $newsModel = $this->model('news');
                $newsModel->addnew($_POST['type'],$_POST['title'],$_POST['new'], $this->session->getPseudo());
                $this->output->success('img_admin','Ajout d\'une nouvelle','Nouvelle ajoutée avec succès !<br/>Vous allez être redirigé vers la page de gestion des news.', 'admin', 'news');
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
   public function changenew()
   {
       if($this->session->isAdmin())
       {
            if(isset($_GET['id']) AND is_numeric($_GET['id']))
            {
                $newsModel = $this->model('news');
                if(empty($_POST['type']) AND empty($_POST['title']) AND empty($_POST['new']))
                {
                    if(($new = $newsModel->getnew($_GET['id'])))
                    {
                        $this->output->view('admin/changenew.html.twig',array(
                                'new' => $new
                            ));
                    }else
                    {
                        $this->output->error('img_admin','Erreur SQL','La requête est invalide ! Il est possible que l\'id envoyé soit invalide.<br/>Vous allez être redirigé vers la page des gestion des news.', 'admin', 'news');
                    }
                }else
                {
                    if(is_numeric($_POST['type']))
                    {
                        if($newsModel->changenew($_GET['id'],$_POST['type'],$_POST['title'],$_POST['new']))
                        {
                            $this->output->success('img_admin','Modification de la new','New modifié avec succès.<br/>Vous allez être redirigé vers la page des gestion des news', 'admin', 'news');
                        }else
                        {
                            $this->output->error('img_admin','Erreur SQL','La requête est invalide ! Il est possible que l\'id envoyé soit invalide.<br/>Vous allez être redirigé vers la page des gestion des news.', 'admin', 'news');
                        }
                    }else
                    {
                        $this->output->error('img_admin','Erreur','Type de la nouvelle invalide !<br/>Vous allez être redirigé vers la page des gestion des news.', 'admin', 'news');
                    }
                }
            }else
            {
                $this->output->error('img_admin','Erreur','Argument invalide !<br/>Vous allez être redirigé vers la page des gestion des news.', 'admin', 'news');
            }
        }else
        {
            $this->output->error_403();
        }
   }
   
   public function fillnews()
   {
       if($this->session->superAdmin())
       {
           $n = intval($_GET['n']);
           $model = $this->model('news');
           for($i = 1; $i <= $n; $i++)
           {
               $model->addnew(1, "new auto n°".$i, "Nouvelle généré automatiquement...", 'script ByxxR');
           }
           $this->output->success('img_admin', 'News ajoutées', 'les news ont été ajoutées avec succès !');
       }else
       {
           $this->output->error_403();
       }
   }
}
