<?php
class TestController extends Controller
{
    public function indexAction()
    {
	$this->formManager->load('test');
	$this->output->view('test/form');
    }
    
    public function validateAction()
    {
	sleep(1);
	$array=array(
	    'email'=>'rgererg',
	    'text'=>'gergerg',
	    'url'=>'ergrge'
	);
	exit(json_encode($array));
    }
}
