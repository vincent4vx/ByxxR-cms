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
        if($this->output->getCachedView('home/news.html.twig', $this->config['cache']['news'], $page) === false)
        {
            $model = $this->loadModel('news');
            $num_news = $model->num();
            
            $last = ceil($num_news / 10);
            $page = $last >= $page ? $page : 1;
            $start = ($page - 1) * $this->config['news_per_page'];
            $num = $this->config['news_per_page'];
            
            $news = $model->selectLimit($start, $num);
            $this->output->view('home/news.html.twig', array(
                'news' => $news,
                'pagi_end' => ceil($num_news / 10),
                'pagi_current' => $page
            ), $page);
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
	$this->output->view('home/presentation',Core::$config['server']['rates']);
    }
    
    public function staffAction()
    {
        if($this->output->startCache('staff'))
        {
            $this->model('account');
            $this->output->view('home/staff', array(
                'staff' => $this->AccountModel->getStaff()
            ));
	    $this->output->endCache($this->config['cache']['staff']);
        }
    }
}
