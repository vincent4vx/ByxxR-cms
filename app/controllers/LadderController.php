<?php
class LadderController extends Controller{
    public function indexAction(){
        $this->persoAction();
    }

    public function persoAction($order = 'xp'){
        if($order!=='xp' && $order!=='kamas')
            $order='xp';

        if($this->output->startCache('ladder.perso.'.$order)){
            $chars = $this->model('character')->ladder(0, 20, $order);
            $this->output->view('ladder/perso', array('chars'=>$chars));
            $this->output->endCache($this->config['cache']['ladder_perso']);
        }
    }

    public function votesAction(){
        if($this->output->startCache('ladder.votes')){
            $this->output->view('ladder/votes', array(
                'accounts'=>$this->model('user')->getVotesLadder()
            ));
            $this->output->endCache($this->config['cache']['ladder_votes']);
        }
    }

    public function guildsAction(){
        if($this->output->startCache('ladder.guild')){
            $this->output->view('ladder/guilds', array(
                'guilds' => $this->model('guild')->ladder()
            ));
            $this->output->endCache($this->config['cache']['ladder_guilds']);
        }
    }
}
