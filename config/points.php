<?php
/*
 * Fichier de configuration des achats / ventes
 * des points, et transactions...
 * Boutique / VIP
 */

return array(
    //CONFIG vote
    //
    //ID RPG Paradize
    'rpg_id'=>36982,

    //points reçu par votes
    'per_vote' => 15,

    //temps d'attente entre 2 votes (en minutes)
    'vote_time' => 2,

    //Activer RpgApi ?
    //Avec RpgApi, vous benificierez d'un vote par captcha sécurisé
    //ainsi que pouvoir suivre depuis le site la postion dans Rpg Paradize
    //NB: Utiliser cette API viole la charte de RPG Paradize. Si vous ne voulez pas
    //que votre serveur se fasse supprimé de RPG, mettez à false.
    'rpgapi'=>false,

    //un vote par IP dans l'intervalle vote_time
    'filter_ip'=>true,
    //FIN config vote
    
    //active la boutique ou non.
    'enable_shop' => false,

    //achats points par starpass :
    'idp' => 87603,
    'idd' => 153507,
    'per_code' => 200
);
