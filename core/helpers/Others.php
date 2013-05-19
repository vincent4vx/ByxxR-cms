<?php
class Others
{
    public static function pagination($current, $end, $url, $num_inter_link=3)
    {
	$end=(int)$end;
	$output='';
	if($current > 2)
	    $output.='<a href="'.$url.'/1#textContent">&lt;&lt;</a>';
	if($current > 1)
	    $output.='<a href="'.$url.'/'.($current-1).'#textContent">&lt;</a>';
	
	$page=$current-$num_inter_link;
	if($page<=1)
	    $page=1;
	else
	    $output.='...';
	
	$page_max=$current+$num_inter_link;
	if($page_max>$end)
	    $page_max=$end;
	
	for(;$page<=$page_max;$page++)
	{
	    if($page!=$current)
		$output.='<a href="'.$url.'/'.$page.'#textContent">'.$page.'</a>';
	    else
		$output.='<span class="current">'.$page.'</span>';
	}
	
	if($page_max < $end)
	    $output.='...';
	
	if($current < $end)
	    $output.='<a href="'.$url.'/'.($current+1).'#textContent">&gt;</a>';
	if($current < $end-1)
	    $output.='<a href="'.$url.'/'.$end.'#textContent">&gt;&gt;</a>';
	return $output;
    }
    
    public static function getHead($class, $sexe, $big = false)
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
    
    public static function bbcode($str)
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
	$str = preg_replace('#\[quote\](.+)\[/quote\]#isU', '<blockquote>$1</blockquote>', $str);


	//smileys
	$str = str_replace(':)', '<img src="'.Core::conf('root').'public/images/devtool/emots/1.png" />', $str);
	$str = str_replace(':D', '<img src="'.Core::conf('root').'public/images/devtool/emots/2.png" />', $str);
	$str = str_replace(':(', '<img src="'.Core::conf('root').'public/images/devtool/emots/3.png" />', $str);
	$str = str_replace(';)', '<img src="'.Core::conf('root').'public/images/devtool/emots/4.png" />', $str);
	$str = str_replace(':p', '<img src="'.Core::conf('root').'public/images/devtool/emots/5.png" />', $str);
	$str = str_replace(':o', '<img src="'.Core::conf('root').'public/images/devtool/emots/6.png" />', $str);
	return nl2br($str);
    }

    public static function ladderTr(&$p){
        $p++;
        if($p <= 3){
            $out = '<tr class="pos'.$p.'"><td>';
            $out.=Assets::img('trophy/trophy_'.$p.'.png').'</td>';
        }else
            $out = '<tr><td style="text-align: center;">'.$p.'</td>';

        return $out;
    }

    public static function random_string($size = 12){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';

        for($i = 0; $i < $size; $i++){
            $str.=substr($chars, rand(0, 62), 1);
        }

        return $str;
    }

    public static function getStats(){
        if(($stats = Core::get_instance()->loader->get('Cache')->get('stats'))===null){
            $stats = Core::get_instance()->loader->loadModel('Stats')->globalStats();
            Core::get_instance()->loader->get('Cache')->set('stats', $stats, Core::get_instance()->config['cache']['stats']);
        }

        return $stats;
    }
}
