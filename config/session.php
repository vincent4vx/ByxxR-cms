<?php
    /*
     * gestion des sessions
     */

return array(
    //driver par les sessions
    //utilisez de préférence apc, si non disponible, utilisez soit database ou file
    'driver'=>'apc',
    
    //nom du cookie enregistrant le SESSID. Modification non obligatoire !
    'cookie_name'=>'ByxxR-SESSID',
    
    //intervale entre 2 maj de la session (n'influence que très peu sur le cms)
    'update' => 600,
    
    //temps d'inativité minimum pour arrêter la session (en sec)
    'destroy' => 7200,
    
    //nombre de tentatives de connexion
    'connect_attemps' => 5,
    
    //temps à attendre si toutes le tentatives ont échoué (en secondes)
    'connect_time' => 10
);
