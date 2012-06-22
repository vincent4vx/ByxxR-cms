<?php
//fichier de configuration des membres du staff
return array(
    
    //level mini pour pouvoir gérer le site
    'level' => 3,
    
    //rang des membres du staff en fonction du niveau
    //vous pouvez ajouter des niveaux, en enlever, changer les noms, ect...
    'rank' => array(
        1 => 'Animateur',
        2 => 'Modérateur',
        3 => 'Super modérateur',
        4 => 'Codeur',
        5 => 'Administrateur'
    ),
    
    //id du super administrateur
    //le super admin a tout les droits quelque soit son level
    //seul le super admin peu modifier l'équipe du serveur
    //son compte ne peu pas être bani, modifié, ou supprimé
    //mettez -1 pour désactiver
    'super_admin' => 999979526
);
