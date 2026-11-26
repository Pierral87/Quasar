<?php 

// Amélioration de notre autoload pour qu'il soit capable de gérer les namespaces liés avec des sous dossiers

// On va respecter la convention PSR-4, c'est à dire lier l'autoload à src 



function inclusionAuto(string $class)
{ // Ici mon param $class va être le nom d'une classe, on va s'en servir pour faire un require du fichier contenant cette classe 

    $class = str_replace('\\', '/', $class);

    $file = __DIR__ . "/src/" . $class . ".php";

    // var_dump($file); // Je vérifie ici ma concaténation

    if (file_exists($file)) { // Si on trouve bien un fichier à ce chemin là on rentre dans le if 
        require_once $file; // Je require le fichier
    }

}

spl_autoload_register("inclusionAuto");