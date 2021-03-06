<?php
class account extends controller
{
    private $logged;
    private $id;
    
    public function __construct() {
        parent::__construct();
	$this->logged = $this->session->isLog();
	$this->id = $this->session->getId();
    }
    
    public function index()
    {
        if($this->logged)
        {
            if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id) === false)
            {
                $model = $this->model('maccount');
                $this->output->view('account/account.html.twig', array(
                    'account' => $model->getAccount($this->id)
                ), $this->id);
            }
        }else
        {
            $this->login();
        }
    }
    
    public function login()
    {
        if(!$this->logged)
        {
            if($this->session->get('attemps') === false or ($this->session->get('connect_time') !== false and $this->session->get('connect_time') <= time()))
            {
                $this->session->set('attemps', $this->config['connect_attemps']);
                $this->session->destroy('connect_time');
            }
            $this->session->dec('attemps');
            if($this->session->get('attemps') >= 1)
            {
                if(isset($_POST['login']) and isset($_POST['passlog']))
                {
                    $model = $this->model('maccount');
                    $data = $model->login($_POST['login'], $_POST['passlog']);
                    if($data !== false)
                    {
			if(in_array(array($data['lastIP'], 'ip' => $data['lastIP']), $model->getIpBlackList()) ||
				$data['banned'] == 1)
			{
			    $this->output->error('img_profil', 'Compte banni', 'Le compte à été banni !');
			}else
			{
			    $this->session->login($data);
			    $this->output->success('img_profil', 'Connecté', 'Vous êtes maintenant connecté !');
			}
                    }else
                    {
                        $this->output->view('account/login.html.twig');
                    }
                }else
                {
                    $this->output->view('account/login.html.twig');
                }
            }else
            {
                if(($this->session->get('connect_time') !== false and $this->session->get('connect_time') >= time()) or $this->session->get('connect_time') === false)
                {
                    $this->session->set('connect_time', time() + $this->config['connect_time']);
                }
                $this->output->error('img_profil', 'Erreur de connexion', 'Vous avez utilisé toutes les <b>'.$this->config['connect_attemps'].'</b> tentatives de connexions possibles. Vous devez attendre <b>'.$this->config['connect_time'].'sec</b> pour pouvoir recommencer !');
            }
        }else
        {
            $this->index();
        }
    }
    
    public function logout()
    {
        if($this->logged)
        {
            $this->session->logout();
            $this->output->success('img_profil', 'Déconnexion', 'Vous êtes maintenant déconnecté !');
        }else
        {
            $this->index();
        }
    }
    
    public function register()
    {
        if(!$this->logged)
        {
            if(!isset($_GET['finish']))
            {
                $this->output->view('account/register.html.twig');
            }else
            {
                $error = false;
                $errors = array();
                $mainR = '#^[a-z0-9_-]{4,24}$#isU';
                $emailR = '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#isU';
            
                if(!isset($_POST['name']) or !preg_match($mainR, $_POST['name']))
                {
                    $error = true;
                    $errors['Nom de Compte'] = 'Champ invalide ou inexistant. (le nom de compte ne doit pas comporter de caractères spéciaux, et doit allez de 4 à 24 caractères)';
                }
            
                if(!isset($_POST['pass']) or !preg_match($mainR, $_POST['pass']))
                {
                    $error = true;
                    $errors['Mot de passe'] = 'Champ invalide ou inexistant. (le mot de passe ne doit pas comporter de caractères spéciaux, et doit allez de 4 à 24 caractères)';
                }
            
                if(!isset($_POST['pass2']) or $_POST['pass'] !== $_POST['pass2'])
                {
                    $error = true;
                    $errors['Confirmez le mot de passe'] = 'Mots de passes différents (ou champ inexistant).';
                }
            
                if(!isset($_POST['pseudo']) or !preg_match($mainR, $_POST['pseudo']))
                {
                    $error = true;
                    $errors['Pseudo'] = 'Champ invalide ou inexistant. (le pseudo ne doit pas comporter de caractères spéciaux, et doit allez de 4 à 24 caractères)';
                }
            
                if(isset($_POST['mail']) and !preg_match($emailR, $_POST['mail']))
                {
                    $error = true;
                    $errors['email'] = 'L\'email entré est invalide !';
                }
            
                if($error)
                {
                    $this->output->view('account/register.html.twig', array('error' => true, 'errors' => $errors, 'post' => $_POST));
                }else
                {
                    $model = $this->model('maccount');
                    if($model->accountExist($_POST['name']))
                    {
                        $error = true;
                        $errors['Nom de Compte'] = 'Nom de compte existant. Veuillez en choisir un autres.';
                    }
                
                    if($model->pseudoExist($_POST['pseudo']))
                    {
                        $error = true;
                        $errors['Pseudo'] = 'Pseudo existant. Veuillez en choisir un autre.';
                    }
                
                    if($error)
                    {
                        $this->output->view('account/register.html.twig', array('error' => true, 'errors' => $errors, 'post' => $_POST));
                    }else
                    {
                        $model->createAccount($_POST['name'], $_POST['pseudo'], $_POST['pass'], $_POST['secretquestion'], $_POST['secretanswer'], $_POST['mail']);
                        $this->output->success('img_inscription', 'Compte créé', 'Le compte a été créé avec succès. Ne communiquez à personnes les identifiants, même aux membres du staff.');
                    }
                }
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function changeinfo()
    {
        if($this->logged)
        {
            if(isset($_POST['infos']))
            {
                if(strlen($_POST['infos']) <= 110)
                {
                    $model = $this->model('maccount');
                    $model->set($this->id, 'infos', $_POST['infos']);
		    $this->delCache();
                    $this->output->success('img_profil', 'Informations changées', 'Les informations ont été changé avec succès !<br/>Vous allez être redirigé vers la page de profil.', 'account');
                }else
                {
                    $this->output->error('img_profil', 'Erreur', 'Le nombre maxi de caractères a été dépassé (<b>110</b> caractères !<br/>Vous allez être redirigé vers cette même page.', 'account', 'changeinfo');
                }
            }else
            {
                $model = $this->model('maccount');
                $infos = $model->get($this->id, 'infos', true);
                if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array(
                    'param' => 'changeinfo',
                    'account' => $infos
                )) === false)
                {
                        $this->output->view('account/account.html.twig', array(
                        'account' => $model->getAccount($this->id),
                        'param' => 'changeinfo'
                    ), $this->id);
                }
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function changeimg()
    {
        if($this->logged)
        {
            if(isset($_FILES['avatar']))
            {
                if($_FILES['avatar']['error'] < 1)
                {
                    if(in_array(strchr($_FILES['avatar']['name'], '.'), array(
                        '.jpg', '.jpeg', '.gif', '.png'
                    )) and $_FILES['avatar']['size'] < 8 * 150000)
                    {
                        $size = getimagesize($_FILES['avatar']['tmp_name']);
                        if($size[0] <= 140 and $size[1] <= 140 and $size[0] > 5 and $size[1] > 5)
                        {
                            $dir_name = BASE.'public/images/avatars/uploaded/'.$this->session->getPseudo();
                            if(!is_dir($dir_name))
                            {
                                mkdir($dir_name, 0777, true);
                            }
                            $file_name = uniqid(substr($_FILES['avatar']['name'], 0, 5).'-', true);
                            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_name.'/'.$file_name))
                            {
                                $model = $this->model('maccount');
                                $model->set($this->id, 'avatar', 'uploaded/'.$this->session->getPseudo().'/'.$file_name);
				$this->delCache();
                                $this->output->success('img_profil', 'Image changée', 'L\'image a été changé avec succès !<br/>Vous allez être redirigé vers la page de profil', 'account');
                            }else
                            {
                                $this->output->error('img_profil', 'Erreur lors du transfert', 'Une erreur est survenue lors du tranfert de l\'image... Veuillez réessayer.', 'account', 'changeimg');
                            }
                        }else
                        {
                            $this->output->error('img_profil', 'Dimentions invalides !', 'Les dimentions de l\'image (<b>'.$size[0].'</b>x<b>'.$size[1].'</b>px) sont invalides. Les dimentions maximales autorisées sont de <b>140</b>x<b>140</b>px !', 'account', 'changeimg');
                        }
                    }else
                    {
                        $this->output->error('img_profil', 'Image invalide', 'Le fichier n\'est pas de type valide, ou de poid trop important (<b>150</b>Ko max) !', 'account', 'changeimg');
                    }
                }else
                {
                    $this->output->error('img_profil', 'Erreur lors du transfert', 'Une erreur est survenue lors du transfert de l\'avatar. Assurez vous que le fichier soit valide.', 'account', 'changeimg');
                }
            }elseif(!empty($_GET['i']) and !empty($_GET['d']))
            {
                if(in_array(strrchr($_GET['i'], '.'), array(
                    '.jpg', '.jpeg', '.gif', '.png'
                )))
                {
                    $path = ($_GET['d'] == 'private' ? 'uploaded/'.$this->session->getPseudo().'/' : '').$_GET['i'];
                    $model = $this->model('maccount');
                    $model->set($this->id, 'avatar', $path);
		    $this->delCache();
                    $this->output->success('img_profil', 'Image changée', 'L\'image d\'avatar a été changé avec succès !<br/>Vous allez être redirigé vers votre profil', 'account');
                }else
                {
                    $this->output->error('img_profil', 'Image invalide !', 'L\'image donnée est invalide !<br/>Vous allez être redirigé vers la page de profil.', 'account');
                }
            }else
            {
                if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array('param' => 'change_img')) === false)
                {
                    $model = $this->model('maccount');
                    $this->output->view('account/account.html.twig', array(
                        'account' => $model->getAccount($this->id),
                        'param' => 'change_img'
                    ), $this->id);
                }
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function listimg()
    {
        if($this->logged)
        {
            $public_dir = scandir(BASE.'public/images/avatars');
            $private_dir = null;
            if(is_dir(BASE.'public/images/avatars/uploaded/'.$this->session->getPseudo()))
            {
                $private_dir = scandir(BASE.'public/images/avatars/uploaded/'.$this->session->getPseudo());
            }
            $this->output->view("account/list_img.html.twig", array(
                'account_img' => $private_dir,
                'public_img' => $public_dir
            ));
        }else
        {
            $this->output->error_404();
        }
    }
    
    public function changepass()
    {
        if($this->logged)
        {
            $model = $this->model('maccount');
            if(!empty($_POST['oldpass']) and !empty($_POST['answer']) and !empty($_POST['npass1']) and !empty($_POST['npass2']))
            {
                $accountDatas = $model->get($this->id, array('pass', 'question', 'reponse'));
                $errors = array();
                $error = false;
                if($_POST['oldpass'] != $accountDatas['pass'])
                {
                    $error = true;
                    $errors['oldpass'] = true;
                }
                $PRegex = '#^[a-z0-9._-]{6,32}$#isU';
                if(!preg_match($PRegex, $_POST['npass1']))
                {
                    $error = true;
                    $errors['npass1'] = true;
                }
                if($_POST['npass1'] != $_POST['npass2'])
                {
                    $error = true;
                    $errors['npass2'] = true;
                }
                if($_POST['answer'] != $accountDatas['reponse'])
                {
                    $error = true;
                    $errors['answer'] = true;
                }
                
                if($error)
                {
                    if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array(
                        'param' => 'changepass', 
                        'account' => $accountDatas,
                        'errors' => $errors,
                        'post' => $_POST
                    )) === false)
                    {
                        $this->output->view('account/account.html.twig', array(
                            'account' => $model->getAccount($this->id),
                            'param' => 'changepass',
                            'errors' => $errors,
                            'post' => $_POST
                        ), $this->id);
                    }
                }else
                {
                    $model->set($this->id, 'pass', $_POST['npass1']);
		    $this->delCache();
                    $this->output->success('img_profil', 'Mot de passe changé', 'Le mot de passe a été changé avec succès !<br/>Vous allez être redirigé vers la page de profil.', 'account');
                }
            }else
            {
                $question = $model->get($this->id, 'question', true);
                if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array('param' => 'changepass', 'account' => $question)) === false)
                {
                    $this->output->view('account/account.html.twig', array(
                        'account' => $model->getAccount($this->id),
                        'param' => 'changepass'
                    ), $this->id);
                }
            }
        }else
        {
            $this->output->error_403();
        }
    }
    
    public function delete()
    {
	if($this->logged)
	{
	    $model = $this->model('maccount');
	    if(!empty($_POST['reponse']) and !empty($_POST['pass']))
	    {
		$pass = $model->get($this->id, 'pass');
		$reponse = $model->get($this->id, 'reponse');
		if($_POST['pass'] == $pass)
		{
		    if($_POST['reponse'] == $reponse)
		    {
			$model->delete($this->id);
			//$this->output->success('img_profil', 'Compte supprimé avec succès !', 'Le Compte à bien été supprimé.<br/>Vous ne pourrais plus retrouver ni ses personnages, ni tout autres données de ce compte.');
			$this->logout();
		    }else
		    {
			$this->output->error('img_profil', 'Réponse incorrecte', 'La réponse entré ne correspond pas à celle présente dans la base de donnée.', 'account', 'delete');
		    }
		}else
		{
		    $this->output->error('img_profil', 'Mot de passe incorrect', 'Le mot de passe entré ne correspond pas à celui présent dans la base de donnée.', 'account', 'delete');
		}
	    }else
	    {
		if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array('param' => 'changemail')) === false)
                {
                    $this->output->view('account/account.html.twig', array(
                        'account' => $model->getAccount($this->id),
                        'param' => 'delete'
                    ), $this->id);
                }
	    }
	}else
	{
	    $this->output->error_403();
	}
    }
    
    public function changemail()
    {
	if($this->logged)
	{
	    $model = $this->model('maccount');
	    if(!empty($_POST['mail']) and !empty($_POST['pass']))
	    {
		$pass = $model->get($this->id, 'pass');
		if($_POST['pass'] == $pass)
		{
		    $MRegex = '#^[a-z0-9._-]+@[a-z0-9._-]{4,}\.[a-z]{2,4}$#isU';
		    if(preg_match($MRegex, $_POST['mail']))
		    {
			$model->set($this->id, 'email', $_POST['mail']);
			$this->delCache();
			$this->output->success('img_profil', 'Adresse E-mail changée avec succès', 'L\'adresse E-mail a belle est bien était changée avec succès.<br/>Vous allez être redirigé vers la page de profil.', 'account');
		    }else
		    {
			$this->output->error('img_profil', 'E-mail invalide', 'L\'E-mail entré n\'est pas valide (schéma : <b>xxx@xxx.xx</b>).', 'account', 'changemail');
		    }
		}else
		{
		    $this->output->error('img_profil', 'Mot de passe incorrect', 'Le mot de passe entré ne correspond pas à celui présent dans la base de donnée.', 'account', 'changemail');
		}
	    }else
	    {
		if($this->output->getCachedView('account/account.html.twig', $this->config['cache']['profil'], $this->id, array('param' => 'changemail')) === false)
                {
                    $this->output->view('account/account.html.twig', array(
                        'account' => $model->getAccount($this->id),
                        'param' => 'changemail'
                    ), $this->id);
                }
	    }
	}else
	{
	    $this->output->error_403();
	}
    }
    
    private function delCache()
    {
	$file = 'account/account.html.twig'.$this->id;
	$this->cache->delete($file);
    }
}
