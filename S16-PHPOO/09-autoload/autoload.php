<?php 

/* 
    - Autoload : Concept de base 

    En PHP l'autoload nous sert à charger les fichiers contenant nos classes automatiquement

    Sans autoload on devrait require nous même tous nos fichiers 
*/

// require "classes/Utilisateur.php";
// require "classes/UtilisateurController.php";
// require "classes/FormValidator.php";
// require "classes/SessionManager.php";
// require "classes/Config.php";

/* 

Le but de l'autoload est donc d'insérer dans le fichier en cours UNIQUEMENT les classes dont on a besoin. 
Comment ça marche ? Dès lors que l'autoload vers la mention d'une classe, soit par un new, soit par un appel static par exemple, il sera capable d'avant l'instruction en question, d'insérer le fichier contenant cet élément nommé 

Par exemple : 
$article = new Article;
L'autoload va comprendre qu'il doit require("Article.php");

*/

// Création d'un autoload à la mano 

function inclusionAuto(string $class)
{ // Ici mon param $class va être le nom d'une classe, on va s'en servir pour faire un require du fichier contenant cette classe 

    $file = __DIR__ . "/Classes/" . $class . ".php";

    // var_dump($file); // Je vérifie ici ma concaténation

    if (file_exists($file)) { // Si on trouve bien un fichier à ce chemin là on rentre dans le if 
        require_once $file; // Je require le fichier
    }

}

// spl_autoload_register c'est une fonction qui se déclenche dès qu'elle voit une instanciation ou un appel static
// Elle comprend ici qu'elle doit lancer une fonction qui s'appelle inclusionAuto()
// Elle enverra automatiquement un param étant le nom de la classe (comprennant le namespace s'il y en a un!)
spl_autoload_register("inclusionAuto");

// $article = new Article; // Ici ça marche, l'instanciation est comprise par l'autoload, le fichier s'ajoute 
// On va plutôt le faire au travers d'une page séparée page1.php