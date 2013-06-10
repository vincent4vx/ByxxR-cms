<?php
/*
 * fichier de configuaration général
 */
return array(
    //inclusion des fichiers de configurations
    //ne pas toucher !
    'database' => require 'database.php',
    'server' => require 'server.php',
    'admin' => require 'admin.php',
    'cache' => require 'cache.php',
    'points' => require 'points.php',
    'session' => require 'session.php',
    'user' => require 'user.php',
    'forum' => require 'forum.php',
    //FIN
    
    //url de base (url de racine du cms)
    //ne pas oublier le http:// et le / final !
    'root' => 'http://127.0.0.1/byxxr/',
    
    //mode rewrite activé (avec un .htaccess qui permet de ne pas écrire le index.php dans l'url)
    'rewrite' => false,
    
    //Langage
    'lang'=>'fr',
    
    

    
    //nombre de nouvelles par page
    'news_per_page' => 5,

    'use_localstorage' => true
);
