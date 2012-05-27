<?php
/*
 * class d'output
 * marche grâce à twig
 */
class output
{
    protected $twig;
    protected $output = '';
    
    public function __construct()
    {
        require_once CORE.'twig/lib/Twig/Autoloader'.EXT;
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(APP.'views/');
        $cache_path = CORE.'cache/twig/';
        if(DEBUG)
        {
            $cache_path = false;
        }
        $this->twig = new Twig_Environment($loader, array(
            'cache' => $cache_path,
        ));
        global $session;
        $this->twig->addGlobal('config', $GLOBALS['config']);
        $this->twig->addGlobal('session', $session);
        
        //chargement des extensions twig
        include CORE.'twig/extensions/assets'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\assets());
        include CORE.'twig/extensions/url'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\url());
        include CORE.'twig/extensions/cache'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\cache());
        include CORE.'twig/extensions/tools'.EXT;
        $this->twig->addExtension(new App\AppBundle\Twig\Extension\tools());
    }
    
    public function getCachedView($name, $time = 60, $id = '', $vars = array())
    {
        if($GLOBALS['config']['cache']['driver'] == 'file')
        {
            $filename = CORE.'cache/pages/'.$name.$id.'.cache';
            if(file_exists($filename))
            {
                if((filemtime($filename) + $time) >= time() and !DEBUG)
                {
                    $this->output .= $this->twig->render($name, array(
                        'name' => $name.$id
                    ) + $vars);
                }else
                {
                    unlink($filename);
                    return false;
                }
            }else
            {
                return false;
            }
        }elseif($GLOBALS['config']['cache']['driver'] == 'apc')
        {
            if(apc_exists($name.$id))
            {
                if((apc_fetch($name.$id.'-age') + $time) >= time())
                {
                    $this->output .= $this->twig->render($name, array(
                        'name' => $name.$id
                    ) + $vars);
                }else
                {
                    apc_delete($name.$id);
                    apc_delete($name.$id.'-age');
                    return false;
                }
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
    }
    
    public function view($name, $vars = array(), $id = '')
    {
        $vars += array('name' => $name.$id);
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
