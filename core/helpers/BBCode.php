<?php
class BBCode{
    const ALL = 'underline,bold,italic,url,color,size,list,quote,hr,strike,youtube,table,font,baseline,align,dir,img';
    const FONT = 'underline,bold,italic,url,size,color,strikefont,baseline';

    private static function BBCodePatterns(){
        return array(
            'underline' => array('#\[u\](.+)\[/u\]#isU', '<u>$1</u>'),
            'bold' => array('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>'),
            'italic' => array('#\[i\](.+)\[/i\]#isU', '<em>$1</em>'),
            'url' => array(
                array('#[^(url=)(\[img\])](https?://[a-z0-9_/\.-]+\.[a-z]{2,4}([/\?].*)?)#i', '<a href="$1">$1</a>'),
                array('#\[url=(.+)\](.+)\[/url\]#isU', '<a href="$1">$2</a>')
            ),
            'img' => array(
                array('#\[img\](.+)\[/img\]#i', '<img src="$1"/>'),
                array('#\[img=(\d+)x(\d+)\](.+)\[/img\]#', '<img src="$3" width="$1" height="$2"/>')
            ),
            'color' => array('#\[color=(\#[a-f0-9]+)\](.+)\[/color\]#isU', '<font color="$1">$2</font>'),
            'size' => array('#\[size=(\d)\](.+)\[/size\]#isU', function($matches){
                $size = '';
                switch($matches[1]){
                    case '1':
                        $size = 'xx-small';
                        break;
                    case '2':
                        $size = 'x-small';
                        break;
                    case '3':
                        $size = 'small';
                        break;
                    case '4':
                        $size = 'medium';
                        break;
                    case '5':
                        $size = 'large';
                        break;
                    case '6':
                        $size = 'x-large';
                        break;
                    case '7':
                        $size = 'xx-large';
                        break;
                    default:
                        $size = '100%';
                }
                return '<span style="font-size: '.$size.'">'.$matches[2].'</span>';
            }),
            'list' => array(
                array('#\[ul\](.+)\[/ul\]#isU', '<ul>$1</ul>'),
                array('#\[li\](.+)\[/li\]#isU', '<li>$1</li>'),
                array('#\[ol\](.+)\[/ol\]#isU', '<ol>$1</ol>'),
            ),
            'quote' => array('#\[quote\](.+)\[/quote\]#isU', '<blockquote>$1</blockquote>'),
            'hr' => array('#\[hr\]#i', '<hr/>'),
            'strike' => array('#\[s\](.+)\[/s\]#', '<del>$1</del>'),
            'youtube' => array('#\[youtube\](.+)\[/youtube\]#i', '<iframe width="440" height="250" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>'),
            'table' => array(
                array('#\[table\](.+)\[/table\]#isU', '<table>$1</table>'),
                array('#\[tr\](.+)\[/tr\]#isU', '<tr>$1</tr>'),
                array('#\[td\](.+)\[/td\]#siU', '<td>$1</td>')
            ),
            'font' => array('#\[font=(.+)\](.+)\[/font\]#isU', '<span style="font-family:\'$1\';">$2</span>'),
            'baseline' => array(
                array('#\[sup\](.+)\[/sup\]#i', '<sup>$1</sup>'),
                array('#\[sub\](.+)\[/sub\]#i', '<sub>$1</sub>')
            ),
            'align' => array(
                array('#\[center\](.+)\[/center\]#isU', '<div style="text-align: center;">$1</div>'),
                array('#\[right\](.+)\[/right\]#isU', '<div style="text-align: right;">$1</div>'),
                array('#\[justify\](.+)\[/justify\]#isU', '<div style="text-align: justify;">$1</div>'),
                array('#\[left\](.+)\[/left\]#isU', '<div style="text-align: left;">$1</div>'),
            ),
            'dir' => array(
                array('#\[ltr\](.+)\[/ltr\]#isU', '<div dir="ltr">$1</div>'),
                array('#\[rtl\](.+)\[/rtl\]#isU', '<div dir="rtl">$1</div>'),
            )
        );
    }

    public static function emoticons($text){
        $emots = array(
            ':)' => 'smile.png',
            ':angel:' => 'angel.png',
            ':angry:' => 'angry.png',
            '8-)' => 'cool.png',
            ":'(" => 'cwy.png',
            ':ermm:' => 'ermm.png',
            ':D' => 'grin.png',
            '&lt;3' => 'heart.png',
            ':(' => 'sad.png',
            ':O' => 'shocked.png',
            ':P' => 'tongue.png',
            ';)' => 'wink.png',
            ':alien:' => 'alien.png',
            ':blink:' => 'blink.png',
            ':blush:' => 'blush.png',
            ':cheerful:' => 'cheerful.png',
            ':devil:' => 'devil.png',
            ':dizzy:' => 'dizzy.png',
            ':getlost:' => 'getlost.png',
            ':happy:' => 'happy.png',
            ':kissing:' => 'kissing.png',
            ':ninja:' => 'ninja.png',
            ':pinch:' => 'pinch.png',
            ':pouty:' => 'pouty.png',
            ':sick:' => 'sick.png',
            ':sideways:' => 'sideways.png',
            ':silly:' => 'silly.png',
            ':sleeping:' => 'sleeping.png',
            ':unsure:' => 'unsure.png',
            ':woot:' => 'w00t.png',
            ':wassat:' => 'wassat.png'
        );

        foreach($emots as $smiley=>$img)
            $text = str_replace($smiley, Assets::img('emoticons/'.$img), $text);

        return $text;
    }

    public static function parse($text, $opt = self::ALL){
        $text = htmlspecialchars($text);
        $codes = self::BBCodePatterns();

        foreach(explode(',', $opt) as $code){
            $code = trim($code);
            if(!isset($codes[$code])){
                trigger_error("L'option <b>".$code."</b> n'existe pas !");
                continue;
            }

            if(!is_array($codes[$code][0])){
                $pattern = $codes[$code][0];
                if(is_callable($codes[$code][1]))
                    $text = preg_replace_callback ($pattern, $codes[$code][1], $text);
                else
                    $text = preg_replace ($pattern, $codes[$code][1], $text);
            }else{
                foreach($codes[$code] as $array){
                    $pattern = $array[0];
                    if(is_callable($array[1]))
                        $text = preg_replace_callback ($pattern, $array[1], $text);
                    else
                        $text = preg_replace ($pattern, $array[1], $text);
                }
            }
        }

        return '<p style="white-space: pre-line;">'.self::emoticons($text).'</p>';
    }
}
