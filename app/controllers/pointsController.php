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
	    
	}else
	{
	    $this->output->view('points/vote_nolog.html.twig');
	}
    }
}
