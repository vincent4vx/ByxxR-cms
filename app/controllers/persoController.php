<?php
class personnage extends controller
{
    public static function __construct()
    {
	parent::__construct();
    }
    
    public function index()
    {
	$this->persos();
    }
    
    public function persos()
    {
	if($this->session->islog())
	{
	    
	}else
	    $this->output->error_403();
    }
}
