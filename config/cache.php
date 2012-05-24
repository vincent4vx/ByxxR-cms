<?php
/*
 * fichier de configuraton du cache
 * La configuration de ce fichier n'est facultative
 * Le système de cache permet un gain non négligable de performance
 * en contre-partie d'un rafraichissement plus lent
 * Veuillez bien jauger le rapport performance / confort
 * Les valeurs correspondent au temps de rafraichissement, en secondes
 * 
 * /!\ Les parties administrations ne sont pas touché par le cache /!\
 */
return array(
    
    //Système de cache. apc ou file
    //sur mon ordinateur file est plus performant
    //mais apc est une bonne alternative pour de fort trafique
    //Pour ceux utilisant xampp ou wamp, apc n'es pas disponible.
    //à vous de voir les performance, en mettant true à benchmark (sur index.php)
    //et en changeant les driver de cache
    'driver' => 'file',
    
    //ladders
    'ladder_perso' => 3600,
    'ladder_votes' => 3600,
    'ladder_guilds' => 7200,
    //FIN ladders
    
    //cas particulier : le cache se gère automatiquement, d'où un chiffre haut
    'news' => 24 * 3600,
    
    //idem (mais un temps plus bas, en cas de modification des infos, ou de l'avatar)
    'staff' => 12 * 3600,
    
    //idem
    'profil' => 24 * 3600
);
