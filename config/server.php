<?php
/*
 * fichier de configuration du serveur
 */
return array(
    
    //nom du serveur
    'name' => 'ByxxR CMS',
    
    //url du forum
    'forum' => 'http://127.0.0.1/forum',
    
    //rates du serveur
    'rates' => array(
        'xp' => 1,
        'pvp' => 1,
        'honor' => 1,
        'drop' => 1,
        'kamas' => 1
    ),
    //FIN rates
    
    //level départ / level max
    'start_level' => 1,
    'max_level' => 200,
    
    //kamas de départ
    'start_kamas' => 0,
    
    //type de serveur
    'server_type' => 'like',
    
    //HISTOIRE du serveur affiché dans "présentation"
    'histoire' => 'Entrez ici l\'histoire du serveur...',
    
    
    //path et nom du fichier de configuration de dofus config.xml
    //il doit impérativement se trouver dans le dossier public !
    //le nom du fichier importe peu, car lors du téléchargement, le nom du fichier sera dans tout les cas "config.xml"
    'config' => 'config.xml',
    
    //lien vers l'installateur dofus
    'dofus' => 'installer.exe'
);
