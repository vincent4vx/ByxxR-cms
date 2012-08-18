<?php
/*
 * class d'output
 * marche grâce à twig
 */
class Output
{
    protected $stats;
    protected $contents=''; 
    protected $_vars=array();
       
    protected $cache_id;
    protected $cache_vars=array();
    protected $cache_contents='';
    protected $cache_on=false;


    public function __construct()
    {	
	//chargement des stats
	/*include CORE.'stats'.EXT;
	$stats = new statsTable();
	$this->stats = $stats->getStats();*/
    }
    
    public function __get($name)
    {
	if(isset($this->_vars[$name]))
	    return $this->_vars[$name];
	return Loader::getClass(ucfirst(strtolower($name)));
    }
    
    public function view($file, array $vars=array())
    {
	$view=new View($file, $vars);
	if($this->cache_on===false)
	{
	    $this->contents.=$view->getContent();
	    $this->_vars+=$view->_vars;
	}
	else
	{
	    $this->cache_contents.=$view->getContent();
	    $this->cache_vars+=$view->getVars();
	}
    }
    
    public function error_404()
    {
        header('HTTP/1.1 404 Not Found');
        $this->view('statuts/error_404');
    }
    
    public function error_403()
    {
        header('HTTP/1.1 403 Forbidden');
        $this->view('statuts/error_403.html.twig');
    }
    
    public function success($image, $title, $message, $controller = '', $method = '')
    {
        $this->view('statuts/success.html.twig', array(
            'image' => $image,
            'titre' => $title,
            'message' => $message,
            'controller' => $controller,
            'method' => $method
        ));
    }
    
    public function error($image, $title, $message, $controller = '', $method = '')
    {
        $this->view('statuts/error.html.twig', array(
            'image' => $image,
            'titre' => $title,
            'message' => $message,
            'controller' => $controller,
            'method' => $method
        ));
    }
    
    public function display()
    {
	if(empty($this->contents))
	    return;
	require_once APP.'views/layout.html.php';
    }
    
    public function startCache($id)
    {
	$data=Loader::getClass('Cache')->get($id, array('driver'=>Core::$config['cache']['driver'], 'path'=>'pages'));
	if($data===false)
	{
	    $this->cache_on=true;
	    $this->cache_id=$id;
	    return true;
	}
	$this->contents.=$data['contents'];
	$this->_vars+=$data['vars'];
	return false;
    }
    
    public function endCache($time=60)
    {
	Loader::getClass('Cache')->set($this->cache_id, array('vars'=>$this->cache_vars, 'contents'=>  $this->cache_contents), $time, array('driver'=>Core::$config['cache']['driver'], 'path'=>'pages'));
	$this->_vars+=$this->cache_vars;
	$this->contents.=$this->cache_contents;
    }
}
