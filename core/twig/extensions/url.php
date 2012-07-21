<?php
namespace App\AppBundle\Twig\Extension;
 
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class url extends \Twig_Extension
{
    protected $config;
    
    public function __construct()
    {
        $this->config =& \Core::$config;
    }
    public function getName()
    {
        return 'url';
    }
    
    public function getFunctions()
    {
        return array(
            'base_url' => new \Twig_Function_Method($this, 'base_url'),
            'url' => new \Twig_Function_Method($this, 'url'),
            'link' => new \Twig_Function_Method($this, 'link', array('is_safe' => array('html'))),
            'img_url' => new \Twig_Function_Method($this, 'img_url')
        );
    }
    
    public function base_url()
    {
        return $this->config['root'];
    }
    
    public function url($controller = '', $method = '')
    {
        $url = $this->base_url();
        if(!$this->config['rewrite'])
        {
            $url .= 'index.php/';
        }
        $url .= $controller;
        if($method !== '')
        {
            $url .= '/'.$method;
        }
        return $url;
    }
    
    public function img_url($img)
    {
        return $this->base_url().'public/images/'.$img;
    }
    
    public function link($title, $controller = '', $method = '', $class = '')
    {
        $link =  '<a href="'.$this->url($controller, $method).'"';
        if($class !== '')
        {
            $link .= ' class="'.$class.'"';
        }
        $link .= '>'.$title.'</a>';
        return $link;
    }
}