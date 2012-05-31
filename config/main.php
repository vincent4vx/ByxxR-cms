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
    //FIN
    
    //url de base (url de racine du cms)
    //ne pas oublier le http:// et le / final !
    'root' => 'http://127.0.0.1/ByxxR/',
    
    //mode rewrite activé (avec un .htaccess qui permet de ne pas écrire le index.php dans l'url)
    'rewrite' => true,
    
    
    /*
     * gestion des sessions
     */    
    //intervale entre 2 maj de la session (n'influence que très peu sur le cms)
    'update_session_time' => 600,
    
    //temps d'inativité minimum pour arrêter la session (en sec)
    'destr_session_time' => 7200,
    
    //nombre de tentatives de connexion
    'connect_attemps' => 5,
    
    //temps à attendre si toutes le tentatives ont échoué (en secondes)
    'connect_time' => 10,
    
    //nombre de nouvelles par page
    'news_per_page' => 10
);
