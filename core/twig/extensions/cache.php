<?php
namespace App\AppBundle\Twig\Extension;
 
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class cache extends \Twig_Extension
{
    private $driver;
    
    public function __construct()
    {
        $this->driver = $GLOBALS['config']['cache']['driver'];
    }
    
    public function getName()
    {
        return 'Cache';
    }
    
    public function getFunctions()
    {
        return array(
            'getCache' => new \Twig_Function_Method($this, 'getCache')
        );
    }
    
    public function getFilters()
    {
        return array(
            'cache' => new \Twig_Filter_Method($this, 'cache', array('is_safe' => array('html')))
        );
    }
    
    public function cache($string, $file)
    {
        if($this->driver == 'file')
        {
            file_put_contents(CORE.'cache/pages/'.$file.'.cache', $string);
        }elseif($this->driver == 'apc')
        {
            apc_add($file, $string);
            apc_add($file.'-age', time());
        }
        return $string;
    }
    
    public function getCache($file)
    {
        if(DEBUG)
        {
            return false;
        }
        if($this->driver == 'file')
        {
            if(file_exists(CORE.'cache/pages/'.$file.'.cache'))
            {
                return file_get_contents(CORE.'cache/pages/'.$file.'.cache');
            }else
            {
                return false;
            }
        }elseif($this->driver == 'apc')
        {
            if(apc_exists($file))
            {
                return apc_fetch($file);
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
    }
}
