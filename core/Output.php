<?php
class Output
{
    protected $stats;
    protected $contents=''; 
    protected $_vars=array();
       
    protected $cache_id;
    protected $cache_vars=array();
    protected $cache_contents='';
    protected $cache_on=false;

    /**
     * The current session
     * @var Session
     */
    protected $session;

    /**
     * the current instance
     * @var Core
     */
    protected $_instance;


    public function __construct()
    {
        $this->_instance =& Core::get_instance();
        $this->session =& $this->_instance->loader->get('Session');
    }

    /**
     * Add string into contents
     * @param string $contents
     */
    public function add($contents){
        if($this->cache_on)
            $this->cache_contents.=$contents;
        else
            $this->contents.=$contents;
    }

    /**
     * Add a content in the header inclusion
     * @param mixed $var
     */
    public function addHeaderInc($var){
        if($this->cache_on){
            if(!isset($this->cache_vars['headerInc']))
                $this->cache_vars['headerInc'] = '';
            if(!is_array($var))
                $this->cache_vars['headerInc'].=$var;
            else
                    $this->cache_vars['headerInc'].=implode($var);
            
            return;
        }
        if(!is_array($var))
            $this->headerInc.=$var;
        else{
            foreach ($var as $inc)
                $this->headerInc.=$inc;
        }
    }
    
    public function __get($name)
    {
	if(isset($this->_vars[$name]))
	    return $this->_vars[$name];
    }
    
    public function view($file, array $vars=array())
    {
	$view=new View($file, $vars);
	if($this->cache_on===false)
	{
	    $this->contents.=$view->getContent();
	    $this->_vars+=$view->getVars();
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
	require APP.'views/layouts/layout.html.php';
    }
    
    public function startCache($id)
    {
	$data=$this->_instance->loader->get('Cache')
                ->get($this->_instance->config['cache']['driver'].':pages.'.$id);
	if($data===null || DEBUG)
	{
	    $this->cache_on=true;
	    $this->cache_id=$this->_instance->config['cache']['driver'].':pages.'.$id;
	    return true;
	}
	$this->contents.=$data['contents'];
	$this->_vars+=$data['vars'];
	return false;
    }
    
    public function endCache($time=60)
    {
	Core::get_instance()->loader->get('Cache')->set($this->cache_id, array('vars'=>$this->cache_vars, 'contents'=>  $this->cache_contents), $time);
	$this->_vars+=$this->cache_vars;
	$this->contents.=$this->cache_contents;
    }
}
