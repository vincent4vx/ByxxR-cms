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
define('VERSION', '2.0a');
define('DEBUG', false);
define('START_TIME', microtime(true));
try{
    require_once CORE.'Core'.EXT;
    $app=new Core();
    $app->run();
    $app->display();
    $app->benchmarks();
}catch (Exception $e)
{
    if(DEBUG)
    {
	exit($e->getMessage());
    }
}