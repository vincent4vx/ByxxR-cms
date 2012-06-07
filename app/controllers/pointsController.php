<?php
class points extends controller
{
    public function __construct()
    {
	parent::__construct();
    }
    
    public function vote()
    {
	if($this->session->isLog())
	{
	    $model = $this->model('maccount');
	    if(($time = $model->canVote($this->session->getId())) === true)
	    {
		$model->addpoints($this->session->getId(), $this->config['points']['per_vote'], true);
		$model->set($this->session->getId(), 'heurevote', time());
		header('location: '.$this->config['points']['url_vote']);
	    }else
	    {
		$this->output->view('points/vote_error.html.twig', array(
		    'time' => $time
		));
	    }
	}else
	{
	    $this->output->view('points/vote_nolog.html.twig');
	}
    }
}
