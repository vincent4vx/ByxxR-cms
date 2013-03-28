<?php
class PointsController extends Controller{
    public function voteAction(){
        if(!$this->session->isLog())
            return $this->output->view('vote/vote_logout');

        var_dump($this->model('user')->canVoteByIp($this->session->ip));
    }
}
