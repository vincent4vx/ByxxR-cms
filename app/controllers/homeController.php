<?php
class home extends controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $page = 1;
        if(isset($_GET['page']) and is_numeric($_GET['page']))
        {
            $page = $_GET['page'];
        }
        if($this->output->getCachedView('home/news.html.twig', $this->config['cache']['news'], $page) === false)
        {
            $model = $this->model('news');
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
    
    public function news()
    {
        $this->index();
    }
    
    public function cgu()
    {
        $this->output->view('home/cgu.html.twig');
    }
    
    public function join()
    {
        $this->output->view('home/join.html.twig');
    }
    
    public function downloadConf()
    {
        $confPath = BASE.'public/'.$this->config['server']['config'];
        $confData = readfile($confPath);
	header('Content-Type: "text/xml"');
	header('Content-Disposition: attachment; filename="config.xml"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header("Content-Transfer-Encoding: binary");
	header('Pragma: public');
	header("Content-Length: ".filesize($confPath));
        exit($confData);
    }
    
    public function infos()
    {
        $this->output->view("home/presentation.html.twig");
    }
    
    public function staff()
    {
        if($this->output->getCachedView('home/staff.html.twig', $this->config['cache']['staff']) === false)
        {
            $model = $this->model('maccount');
            $this->output->view('home/staff.html.twig', array(
                'staff' => $model->getStaff()
            ));
        }
    }
}
