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
        $this->session->vote_time=time();

        if(!$this->config['points']['rpgapi'])
            $api->redirectVote();
        else
            Url::redirect();
    }
}
