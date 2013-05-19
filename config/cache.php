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
    //ladders
    'ladder_perso' => 3600,
    'ladder_votes' => 3600,
    'ladder_guilds' => 7200,
    //FIN ladders
    
    //cas particulier : le cache se gère automatiquement, d'où un chiffre haut
    'news' => 24 * 3600,
    
    //idem (mais un temps plus bas, en cas de modification des infos, ou de l'avatar)
    'staff' => 10,
    
    //idem
    'profil' => 24 * 3600,
    
    //cache des stats à l'acceuil
    'stats' => 600
);
