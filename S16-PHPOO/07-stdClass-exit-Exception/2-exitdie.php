<?php 

/*

    - exit et die : Arrêter l'exécution du code 

    Les fonctions exit et die en PHP sont utilisées pour arrêter immédiatement l'exécution d'un script. 
    Elles sont identiques et peuvent accepter un message de retour (non obligatoire)
*/
    // Arreter le script avec un message 

    // $uneVar = "J'existe!";

    if(!isset($uneVar)){
        exit("Erreur : Problème d'accès au fichier");
        // exit(); // Ou sans message d'erreur 
        // die();   même utilisation 
    }

    echo "s'execute pas car après le exit";


// Surtout utilisé dans des contrôles d'accès 
// Par exemple arrivée sur une page admin, controle de verification que l'utilisateur est bien un admin, si non, alors on exit ou die le code 

// Pour de la gestion plus précise des erreurs, que ce soit pour les dev ou pour l'utilisateur, on préfèrera passer par un système plus complet à savoir, les Exception ! 