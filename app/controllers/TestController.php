<?php
class TestController extends Controller
{
    public function indexAction()
    {
	$this->formManager->load('test');
	$this->output->view('test/form');
    }
}
