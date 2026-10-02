<?php

// Importation du nom de classe Uuid pour éviter d'utiliser le FQN
use Ramsey\Uuid\Uuid;

// Inclusion de l'autoload, qui va se charger d'amener le fichier de nos classes sur cette page
require "vendor/autoload.php";

// On a suivi la doc, on a initialisé un objet Uuid pour manipuler ces fameux uniq id
$uuid = Uuid::uuid4();

// Je vois que j'ai ici un objet Uuid
var_dump($uuid);

// Avec sa méthode toString je récupère l'id dans un string que je peux concaténer où je le souhaite
var_dump($uuid->toString());


// Pour installer le package avec composer, on a d'abord installé composer 
// Puis, on s'est déplacé dans le dossier actuel 
// Puis on a lancé la commande composer require ramsey\uuid   cela a fait toute l'installation de notre dépendance, que je peux maintenant utiliser dans mon projet 