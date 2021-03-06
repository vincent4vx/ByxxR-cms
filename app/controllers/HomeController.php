<?php
class HomeController extends Controller
{
    public function __construct() {
	parent::__construct();
    }
    
    public function indexAction()
    {
	$this->newsAction();
    }
    
    public function newsAction($page=1)
    {
        $page=(int)$page;
	if($page<1)
	    $page=1;
	
	if($this->output->startCache('news.page'.$page))
	{
            $count=$this->model('news')->num();
	    if($page>$count/$this->config['news_per_page'])
		$page=ceil($count/$this->config['news_per_page']);
            
	    $this->output->view('home/news', 
		array(
		    'news'=>$this->model('news')->get($page),
		    'page'=>$page,
		    'end'=>ceil($count/$this->config['news_per_page'])
	    ));
	    $this->output->endCache($this->config['cache']['news']);
	}
    }
    
    public function cguAction()
    {
	$this->output->view('home/cgu');
    }
    
    public function joinAction()
    {
	$this->output->view('home/join');
    }
    
    public function downloadConfAction()
    {
        $confPath = BASE.'public/'.$this->config['server']['config'];
	header('Content-Type: "text/xml"');
	header('Content-Disposition: attachment; filename="config.xml"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header("Content-Transfer-Encoding: binary");
	header('Pragma: public');
	header("Content-Length: ".filesize($confPath));
        readfile($confPath);
	exit;
    }
    
    public function infosAction()
    {
	$this->output->view('home/presentation', $this->config['server']['rates']);
    }
    
    public function staffAction()
    {
        if($this->output->startCache('staff'))
        {
            $this->output->view('home/staff', array(
                'staff' => $this->model('user')->getStaff()
            ));
	    $this->output->endCache($this->config['cache']['staff']);
        }
    }
}
