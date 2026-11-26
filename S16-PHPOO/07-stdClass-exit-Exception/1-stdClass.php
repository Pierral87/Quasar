<?php 

/*

    1 - stdClass : L'objet generique en PHP

    En PHP, la classe stdClass est une classe générique utilisée pour créer des objets simples contenant uniquement de la data. 
    On l'utilise lorsqu'on préfère utiliser un objet plutot qu'un array 

    Egalement ce sont des objets stdClass que vous  récupérez sur des casting de type ainsi que sur des generations de data automatique 

    */

// Création d'un objet stdClass
$objet = new stdClass();
$objet->nom = "Pierra";
$objet->mail = "pierro@mail.com";

var_dump($objet);

// Un array à transformer en obj 
$array = ["nom" => "Bob", "adresse" => "Bikini Bottom"];

var_dump($array);

$obj = (object) $array;
var_dump($obj);

// On avait déjà vu ça avec PDO, avec le FETCH_OBJ qui me donne un stdClass 
