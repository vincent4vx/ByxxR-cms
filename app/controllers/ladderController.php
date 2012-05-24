<?php
class ladder extends controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $order = 'xp';
        if(isset($_GET['order']) and $_GET['order'] == 'kamas')
        {
            $order = 'kamas';
            if($this->output->getCachedView('ladder/perso.html.twig', $this->config['cache']['ladder_perso'], $order) === false)
            {
                $model = $this->model('perso');
                $this->output->view('ladder/perso.html.twig', array(
                    'persos' => $model->ladderPerso($order)
                ), $order);
            }
        }else
        {
            if($this->output->getCachedView('ladder/perso.html.twig', $this->config['cache']['ladder_perso'], $order) === false)
            {
                $model = $this->model('perso');
                $this->output->view('ladder/perso.html.twig', array(
                    'persos' => $model->ladderPerso($order)
                ), $order);
            }
        }
    }
    
    public function votes()
    {
        if($this->output->getCachedView('ladder/votes.html.twig', $this->config['cache']['ladder_votes']) === false)
        {
            $model = $this->model('maccount');
            $this->output->view('ladder/votes.html.twig', array(
                'accounts' => $model->ladderVote()
            ));
        }
    }
    
    public function guilds()
    {
        if($this->output->getCachedView('ladder/guilds.html.twig', $this->config['cache']['ladder_guilds']) === false)
        {
            $model = $this->model('perso');
            $this->output->view('ladder/guilds.html.twig', array(
                'guilds' => $model->ladderGuilds()
            ));
        }
    }
}
