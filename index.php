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
define('VERSION', '0.7b');
define('DEBUG', false);
define('BENCHMARK', true);

if(BENCHMARK)    
    $time = microtime(true);

require_once CORE.'loader'.EXT;

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