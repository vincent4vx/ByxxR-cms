<?php
class PointsController extends Controller{
    public function voteAction(){
        if(!$this->session->isLog())
            return $this->output->view('vote/vote_logout');

        if(!$this->config['points']['filter_ip'] && !$this->model('user')->canVote())
            return $this->output->view('vote/vote_alreadysent', array(
                'time'=>$this->session->vote_time + $this->config['points']['vote_time']*60 - time()
            ));

        if(!$this->model('user')->canVoteByIp($this->session->ip))
            return $this->output->view('vote/vote_alreadysent', array(
                'time'=>$this->session->vote_time + $this->config['points']['vote_time']*60 - time()
            ));

        if($this->config['points']['rpgapi'])
            $this->output->view('vote/vote_captcha', array('api'=>new RpgApi($this->config['points']['rpg_id'])));
        else
            $this->output->view('vote/vote_noapi');
    }

    public function validatevoteAction(){
        if(!$this->session->isLog())
            return $this->output->view('vote/vote_logout');
        
        if($this->config['points']['filter_ip'] && !$this->model('user')->canVoteByIp($this->session->ip))
            return $this->output->view('vote/vote_alreadysent', array('time'=>$this->session->vote_time));

        if(!$this->model('user')->canVote())
            return $this->output->view('vote/vote_alreadysent', array('time'=>$this->session->vote_time));

        $api = new RpgApi($this->config['points']['rpg_id']);

        if($this->config['points']['rpgapi'] && !$api->submitVote()){
            $this->session->setFlashMsg('Captcha incorrect !', 'NO');
            return Url::redirect('points/vote');
        }

        $this->UserModel->validateVote($this->session->account_id);
        $this->session->setFlashMsg('Vote confirmé. Vous gagnez <b>'.$this->config['points']['per_vote'].'</b> points !');
        $this->session->points += $this->config['points']['per_vote'];
        $this->model('log')->add('+', $this->config['points']['per_vote'], 'vote');
        $this->session->vote_time=time();

        if(!$this->config['points']['rpgapi'])
            $api->redirectVote();
        else
            Url::redirect();
    }

    public function buyPointsAction(){
        if(!$this->session->isLog()){
            $this->session->setFlashMsg('Veuillez vous connecter pour accéder à cette page !', 'NO');
            return Url::redirect();
        }
        $this->output->view('points/buy');
    }

    public function testCodeAction(){
        if(!$this->session->isLog()){
            $this->session->setFlashMsg('Veuillez vous connecter pour accéder à cette page !', 'NO');
            return Url::redirect();
        }
        $idp = $this->config['points']['idp'];
        $idd = $this->config['points']['idd'];
        $ident=$idp.';;'.$idd;

        if(empty($_POST['code'])){
            $this->session->setFlashMsg('Veuillez rentrer le code !', 'NO');
            return Url::redirect('points/buyPoints');
        }

        $codes=$_POST['code'].';;;;';

        $ident=urlencode($ident);
        $codes=urlencode($codes);

        $get_f = file('http://script.starpass.fr/check_php.php?ident='.$ident.'&codes='.$codes.'&DATAS=');

        if(!$get_f){
            $this->session->setFlashMsg('Une erreur est survenue lors de la vérification du code. Il s\'agis peut-être d\'un problème interne à starpass, ou à l\'hébergeur...<br/>Veuillez réessayer plus tard (votre code sera toujours valide !)', 'NO');
            return Url::redirect('points/buyPoints');
        }
        $tab = explode("|",$get_f[0]);

        if(empty($tab[1])){
            $this->session->setFlashMsg('Le code que vous avez rentré est incorrect !', 'NO');
            return Url::redirect('points/buyPoints');
        }

        // dans $pays on a le pays de l'offre. exemple "fr"
        $pays = $tab[2];
        // dans $palier on a le palier de l'offre. exemple "Plus A"
        $palier = urldecode($tab[3]);
        // dans $id_palier on a l'identifiant de l'offre
        $id_palier = urldecode($tab[4]);
        // dans $type on a le type de l'offre. exemple "sms", "audiotel, "cb", etc.
        $type = urldecode($tab[5]);

        if(substr($tab[0],0,3) != "OUI"){
            $this->session->setFlashMsg('Le code rentré est incorrect.', 'NO');
            return Url::redirect('points/buyPoints');
        }

        $this->model('user')->addPoints($this->session->guid, $this->config['points']['per_code']);
        $this->session->points += $this->config['points']['per_code'];
        $info = $_POST['code'].';'.$pays.';'.$palier.';'.$id_palier.';'.$type;
        $this->model('log')->add('+', $this->config['points']['per_code'], $info);
    }
}
