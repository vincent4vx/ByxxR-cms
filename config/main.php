<?php
/*
 * fichier de configuaration général
 */
return array(
    //inclusion des fichiers de configurations
    //ne pas toucher !
    'database' => require_once 'database.php',
    'server' => require_once 'server.php',
    'admin' => require_once 'admin.php',
    'cache' => require_once 'cache.php',
    'points' => require_once 'points.php',
    'session' => require_once 'session.php',
    //FIN
    
    //url de base (url de racine du cms)
    //ne pas oublier le http:// et le / final !
    'root' => 'http://127.0.0.1/ByxxR/',
    
    //mode rewrite activé (avec un .htaccess qui permet de ne pas écrire le index.php dans l'url)
    'rewrite' => true,
    
    

    
    //nombre de nouvelles par page
    'news_per_page' => 10
);
