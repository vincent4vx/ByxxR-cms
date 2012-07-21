<?php
/*
 * class d'output
 * marche grâce à twig
 */
class Output
{
    protected $twig;
    protected $output = '';
    protected $cache;
    protected $stats;


    public function __construct()
    {
	//chargement de la classe cache
	$this->cache =& Loader::getClass('Cache');
	
	//lancement de twig
        require_once CORE.'twig/lib/Twig/Autoloader'.EXT;
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(APP.'views/');
	
	//définition du cache twig
        $cache_path = CORE.'cache/twig';
        if(DEBUG)
        {
            $cache_path = false;
        }
	Loader::manualLoad(new Twig_Environment($loader, array(
            'cache' => $cache_path,
        )), 'twig');
        $this->twig =& Loader::getClass('twig');
	
	//chargement des globals
        $this->twig->addGlobal('config', Core::$config);	
        $this->twig->addGlobal('session', Loader::getClass('Session'));
	
	
	//ajout de filtres / fonctions
	$this->twig->addFilter('save', new Twig_Filter_Function('cache::save', array('is_safe' => array('html'))));
        
        //chargement des extensions twig
        include CORE.'twig/extensions/assets'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\assets());
        include CORE.'twig/extensions/url'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\url());
	//extension cache obsolète. La classe cache remplace cette extension.
        //include CORE.'twig/extensions/cache'.EXT;
        //$this->twig->addExtension(new App\AppBundle\Twig\Extension\cache());
        include CORE.'twig/extensions/tools'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\tools());
	
	//chargement des stats
	include CORE.'stats'.EXT;
	$stats = new statsTable();
	$this->stats = $stats->getStats();
    }
    
    public function getCachedView($name, $time = 60, $id = '', $vars = array())
    {
	if(($data = $this->cache->get($name, $time, $id)) !== false)
	{  		
	    $this->output .= $this->twig->render($name, array(
		'name' => $name.$id,
		'cacheData' => $data,
		'stats' => $this->stats
	    ) + $vars);
	}else
	{
	    return false;
	}
    }
    
    public function view($name, $vars = array(), $id = '')
    {
        $vars += array(
	    'name' => $name.$id,
	    'stats' => $this->stats
	);
        $this->output .= $this->twig->render($name, $vars);
    }
    
    public function error_404()
    {
        header('HTTP/1.1 404 Not Found');
        $this->view('statuts/error_404.html.twig');
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
        echo $this->output;
        $this->output = '';
    }
}
