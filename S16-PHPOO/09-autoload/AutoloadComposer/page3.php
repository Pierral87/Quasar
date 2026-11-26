<?php

/*


    -- Utilisation de l'autoloading de Composer pour nos propres classes 

Composer, outre le fait d'être un outil puissant de gestion de dépendances d'un projet, il nous permet aussi d'intégrer directement un autoload sur notre projet.

L'autoload de composer est basé sur la norme PSR-4 qui va mapper les namespaces aux dossiers du projet et on définira un projet racine 

Il faut créer le fichier composer.json 

{
    "autoload": {
        "psr-4": {
            "ProjetPierra\\": "src/"
        }
    }
}

// Il nous faut créer ce fichier à la main si nous n'avons pas déjà require une library via composer 
// Il spécifie l'appel de l'autoload de composer, en norme psr4 et on lui dit de lier notre namespace principal ProjetPierra au dossier src/ 

Une fois le composer.json créé on lancer la commande suivante :
composer dump-autoload 
Il va ainsi créer le dossier vendor et faire l'installation de l'autoload 

On oublie pas de require le fichier autoload de vendor :) 

Et après c'est parti ! Plus besoin de nous soucier des appels de classes, l'autoload va tout gérer ! (pour peu qu'on ai bien respecté notre convention de nommage de fichier et d'organisation de dossiers !)

*/
use ProjetPierra\Controller\LivreController;
use ProjetPierra\Model\LivreModel;

require "vendor/autoload.php";

$controller = new LivreController;
$model = new LivreModel;