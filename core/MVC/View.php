<?php
class View extends BaseComponent
{
    protected $file;
    protected $content;
    protected $vars;

    public function __construct($file, array $vars = array())
    {
	parent::__construct();
	$this->file=APP.'views/'.$file.'.html.php';
	$this->vars=$vars;
	$this->genView();
    }
    
    private function genView()
    {
	if(!file_exists($this->file))
	    throw new Exception('Vue "'.$this->file.'" inexistante !', '500');
	ob_start();
	extract($this->vars);
	include $this->file;
	$this->content=ob_get_contents();
	ob_end_clean();
    }
    
    public function getContent()
    {
	return $this->content;
    }
    
    public function getVars()
    {
	return Core::get_instance()->globals;
    }
}
