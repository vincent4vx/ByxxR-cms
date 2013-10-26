<?php
/*
 * ByxxR
 * By v4vx
 * code par v4vx
 * thème par nicow,
 * css recodé par v4vx
 */
//constantes
define('BASE', __DIR__.'/');
define('CORE', BASE.'core/');
define('APP', BASE.'app/');
define('EXT', '.php');
define('REV', 190);
define('VERSION', '2.0a (r'.REV.')');
define('DEBUG', true);
define('START_TIME', microtime(true));

$ua = $_SERVER['HTTP_USER_AGENT'];

if(($pos=strpos($ua, 'MSIE '))!==false){
    $v = (int)substr($ua, $pos + 5, 3);
    if($v < 9){
        require 'ie-error'.EXT;
        exit;
    }
}


setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

require_once CORE.'Core'.EXT;
$app=new Core();
$app->run();
$app->display();
$app->benchmarks();