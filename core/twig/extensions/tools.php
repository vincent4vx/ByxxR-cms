<?php
namespace App\AppBundle\Twig\Extension;

class tools extends \Twig_Extension
{
    public function getName()
    {
        return 'tools';
    }
    
    public function getFunctions()
    {
        return array(
            'pagination' => new \Twig_Function_Method($this, 'pagination', array('is_safe' => array('html')))
        );
    }
    
    public function pagination($current, $end, $url)
    {
        $return = '';
        if($current > 1)
        {
            $return = '<a href="'.$url.'?page=1">&lt;&lt;</a> <a href="'.$url.'?page='.($current - 1).'">&lt;</a> ';
        }
        for($i = 1; $i <= $end; $i++)
        {
            if($i == $current)
            {
                $return .= '<b>'.$i.'</b> ';
            }else
            {
                $return .= '<a href="'.$url.'?page='.$i.'">'.$i.'</a> ';
            }
        }
        if($current < $end)
        {
            $return .= '<a href="'.$url.'?page='.($current + 1).'">&gt;</a> <a href="'.$url.'?page='.$end.'">&gt;&gt;</a>';
        }
        return $return;
    }
}
