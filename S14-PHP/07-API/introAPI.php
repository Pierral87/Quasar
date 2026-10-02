<?php

/* 

Qu'est-ce qu'une API (Application Programming Interface) ?

Une API est un ensemble de règles qui permet à une application d'accéder aux services ou aux données d'une autre application. En termes simples, une API permet à des systèmes différents de communiquer entre eux. Par exemple, une application peut utiliser une API pour récupérer la météo, les résultats sportifs, ou toute autre donnée provenant d'un serveur externe.
Comment fonctionne une API en PHP ?

En PHP, on peut utiliser des API pour récupérer ou envoyer des données à un autre serveur via des requêtes HTTP. PHP permet d'envoyer ces requêtes en utilisant des fonctions comme file_get_contents(), curl(), ou des bibliothèques comme Guzzle. Généralement, les API renvoient des réponses sous forme de fichiers JSON (JavaScript Object Notation), que l'on peut ensuite traiter en PHP.

Exemple basique d'utilisation d'une API en PHP
Imaginons une API publique qui renvoie des informations sur la météo au format JSON.

1. Récupération des données depuis une API :

Voici un exemple d'appel à une API de météo en PHP utilisant file_get_contents() pour récupérer les données.

Ce script récupère les données météo actuelles de Paris depuis une API publique, puis extrait et affiche la température.

*/

// URL de l'API publique (par exemple, https://open-meteo.com/)
// https://open-meteo.com/en/docs
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=48.8566&longitude=2.3522&current_weather=true";

// Récupération de la data API en JSON avec file_get_contents()
$response = file_get_contents($apiUrl);

// // Décodage du fichier JSON pour le transformer en ARRAY
$data = json_decode($response, true);
// // $data contient la totalité des infos récupérées par l'API en fonction de la demande envoyée dans le GET
var_dump($data);


// Nous ne sommes pas à l'abri, lorsqu'on appelle une API extérieure, qu'il y est des problèmes de leur côté, auquel cas, le code sur notre site ne fonctionnera pas non plus 
// Pour se protéger de ces éventualités et erreurs "exceptionnelles", on utilisera toujours nos appels API avec des blocs try catch
// Le concept est très simple : 
    // Dans le bloc try : J'essaie d'exécuter du code, si tout va bien, très bien, le code se poursuit, s'il y a un problème (une fatal error), au lieu de déclencher simplement cette erreur, alors on passera dans le bloc catch
    // Dans le bloc catch : Si une erreur est rencontrée dans le try, alors je peux décider moi même ce qui doit s'exécuter en le définissant dans le bloc catch 
// try {
//     $response = file_get_contents($apiUrl);
// } catch(Exception $e) {
//     // var_dump($e);
//     echo "Désolé, le site n'est pas accessible pour le moment";
//     exit;
// }

// Affichage des informations météo
if (isset($data['current_weather'])) {
    $weather = $data['current_weather'];
    echo "La température actuelle à Paris est de " . $weather['temperature'] . "°C.";
} else {
    echo "Impossible de récupérer les données météo.";
}


/* 


Exemples d'API publiques simples à utiliser

Voici quelques exemples d'API publiques que vous pouvez utiliser dans vos pages PHP :

    OpenWeatherMap : Fournit des informations sur la météo actuelle, les prévisions, et les historiques. Nécessite une clé API.
        URL : https://openweathermap.org/api

    REST Countries : Fournit des informations sur les pays du monde (nom, population, drapeau, etc.).
        URL : https://restcountries.com/
        Exemple d'utilisation : Affichage des informations sur un pays via PHP.

    API de citations (Quotable) : Une API simple qui renvoie des citations aléatoires.
        URL : https://api.quotable.io/random
        Exemple d'utilisation : Vous pouvez afficher une citation du jour sur votre page.

     Quelques API simple pour s'entrainer: 
        - CatFacts 
        - Open Meteo 
        - IPify 
        - https://api.gouv.fr/  pour de nombreuses API officielle du gouvernement français 
        
*/