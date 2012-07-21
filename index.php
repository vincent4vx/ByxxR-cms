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
define('BENCHMARK', true);

if(BENCHMARK)    
    $time = microtime(true);

try{
    require_once CORE.'Core'.EXT;
    $app=new Core();
    $app->run();
    $app->display();
}catch (Exception $e)
{
    if(DEBUG)
    {
	exit($e->getMessage());
    }
}

if(BENCHMARK)
{
    $timer = number_format(microtime(true) - $time, 4);
    echo '<table>
            <tr>
                <td>Temps d\'exécution : </td>
                <td>'.$timer.' sec</td>
            </tr>
            <tr>
                <td>Utilisation de mémoire : </td>
                <td>'.(memory_get_usage() / 1000).' Kb</td>
            </tr>
        </table>';
}