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
            'pagination' => new \Twig_Function_Method($this, 'pagination', array('is_safe' => array('html'))),
	    'getHead' => new \Twig_Function_Method($this, 'getHead')
        );
    }
    
    public function getFilters()
    {
	return array(
	    'bbcode' => new \Twig_Filter_Method($this, 'bbcode', array('is_safe' => array('html')))
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
    
    public function getHead($class, $sexe, $big = false)
    {
	switch ($class)
	{
	    case 1:
		$str_class = 'feca';
		break;
	    case 2:
		$str_class = 'osa';
		break;
	    case 3:
		$str_class = 'enu';
		break;
	    case 4:
	        $str_class = 'sram';
		break;
	    case 5:
		$str_class = 'xel';
		break;
	    case 6:
		$str_class = 'eca';
		break;
	    case 7:
		$str_class = 'eni';
		break;
	    case 8:
		$str_class = 'iop';
		break;
	    case 9:
		$str_class = 'cra';
		break;
	    case 10:
		$str_class = 'sadi';
		break;
	    case 11:
		$str_class = 'sacri';
		break;
	    case 12:
		$str_class = 'pand';
		break;
	    default :
		$str_class = '';
		break;
	}
	$str_class .= $sexe == 0 ? '_m' : '_f';
	$path = $big ? 'class/' : 'heads/';
	return $path.$str_class.'.png';
    }
    
    public function bbcode($str)
    {
	$str = htmlspecialchars($str);
	$str = str_replace('&amp;', '&', $str);
	$str = preg_replace('#\[u\](.+)\[/u\]#isU', '<u>$1</u>', $str);
	$str = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $str);
	$str = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $str);
	$str = preg_replace('#\[url=(.+)\](.+)\[/url\]#isU', '<a href="$1">$2</a>', $str);
	$str = preg_replace('#\[color=(\#[a-f0-9]+)\](.+)\[/color\]#isU', '<font color="$1">$2</font>', $str);
	$str = preg_replace('#\[size= (xx-small|x-small|small|medium|large|x-large|xx-large)\](.+)\[/size\]#isU', '<span style="font-size: $1;">$2</span>', $str);
	$str = preg_replace('#\[list=1\](.+)\[/list\]#isU', '<ol>$1</ol>', $str);
	$str = preg_replace('#\[list\](.+)\[/list\]#isU', '<ul>$1</ul>', $str);
	$str = preg_replace('#\[\*\](.+)\n#isU', '<li>$1</li>', $str);
	$str = preg_replace('#\[quote\](.+)\[/quote\]#isU', '<q>$1</q>', $str);
	
	
	//smileys
	$str = str_replace(':)', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/1.png" />', $str);
	$str = str_replace(':D', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/2.png" />', $str);
	$str = str_replace(':(', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/3.png" />', $str);
	$str = str_replace(';)', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/4.png" />', $str);
	$str = str_replace(':p', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/5.png" />', $str);
	$str = str_replace(':o', '<img src="'.$GLOBALS['config']['root'].'public/images/devtool/emots/6.png" />', $str);
	return $str;
    }
}
