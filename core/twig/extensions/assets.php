<?php
namespace App\AppBundle\Twig\Extension;
 
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
 
class assets extends \Twig_Extension
{
    protected $config;
    
    public function __construct()
    {
        $this->config =& $GLOBALS['config'];
    }
    public function getName()
    {
        return 'assets';
    }
    
    public function getFunctions()
    {
        return array(
            'js' => new \Twig_Function_Method($this, 'js', array('is_safe' => array('html'))),
            'css' => new \Twig_Function_Method($this, 'css', array('is_safe' => array('html'))),
            'img' => new \Twig_Function_Method($this, 'img', array('is_safe' => array('html')))
        );
    }
    
    public function js($file)
    {
        return '<script src="'.$this->config['root'].'public/js/'.$file.'.js"></script>';
    }
    
    public function css($file)
    {
        return '<link href="'.$this->config['root'].'public/css/'.$file.'.css" rel="stylesheet" type="text/css" />';
    }
    
    public function img($file, $class = '')
    {
        $img = '<img src="'.$this->config['root'].'public/images/'.$file.'"';
        if($class !== '')
        {
            $img .= ' class="'.$class.'"';
        }
        $img .= ' />';
        return $img;
    }
}