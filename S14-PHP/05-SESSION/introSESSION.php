<?php

/*

    Le système de session en PHP est un mécanisme qui permet de maintenir des informations entre le serveur et le client tout au long de sa navigation, peu importe qu'il change de page ou pas.
    En PHP on a à nouveau une superglobale associée à ce système de session, $_SESSION, encore une fois, c'est un array !!! 
    C'est un array qui est vide par défaut et dans lequel je peux stocker toutes les informations que je souhaite.
    Ces informations pourront m'aider à réinterpréter certains éléments sur mon site web, tout au long de la navigation de l'utilisateur 

À quoi sert une session en PHP ?

Une session est utilisée pour :

    Stocker des informations utilisateur sur plusieurs pages (comme les données de connexion ou le contenu d'un panier d'achat).
    Gérer des états utilisateurs (ex. : savoir si un utilisateur est connecté ou non).
    Protéger les données sensibles sans avoir besoin de les exposer dans des cookies ou des URLs (comme dans le cas de GET).

Fonctionnement des sessions

    Démarrage d'une session : Une session commence quand on appelle session_start(). Cela génère un identifiant unique de session côté serveur et place cet identifiant dans un cookie sur l'ordinateur de l'utilisateur.

    Stockage de données dans $_SESSION : Les données sont stockées dans $_SESSION, qui agit comme un tableau associatif. On peut y ajouter, modifier ou supprimer des informations.

    Persistance entre pages : Tant que la session est active (jusqu'à ce qu'elle soit détruite ou que l'utilisateur ferme le navigateur), ces informations seront accessibles sur toutes les pages.

 */

// Les principales fonctions de gestion de session

// session_start() : Démarre une nouvelle session ou reprend une session existante. Elle doit être appelée au tout début de chaque script utilisant une session.

session_start();


// $_SESSION : Cette superglobale est un tableau associatif qui stocke les informations de session.

$_SESSION['username'] = 'Pierre';
$_SESSION['email'] = 'Pierre@mail.com';
$_SESSION['age'] = 38;

echo $_SESSION['username']; // Affiche 'Pierre'
// unset($_SESSION['username']);

// session_destroy() : Détruit toutes les données de la session sur le serveur. Cependant, cela ne supprime pas automatiquement le cookie de session côté client. On doit aussi supprimer le cookie manuellement si nécessaire.
// session_destroy();

// session_unset() : Supprime toutes les variables de session sans détruire la session elle-même.
// session_unset();

// session_regenerate_id() : Change l'ID de session pour renforcer la sécurité, particulièrement utile après une connexion réussie, pour éviter la fixation de session.
// session_regenerate_id(true);
// Attention à ne pas lancer cette instruction trop souvent, sinon on pourra avoir des pertes de synchro de nos informations
// On lancera plutôt cette instruction après des actions "lourdes", une connexion, une modification d'information, une commande passée, un message posté etc 
// session_regenerate_id(true);


// Etendre la durée de vie de la session pour maintenir la connexion  
// Attention il faut lancer ces instructions de durée de vie des cookie et fichier id serveur avant l'initialisation de la session
// ini_set("session.cookie_lifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du cookie session 
// ini_set("session.gc_maxlifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du fichier de session serveur 
// session_start(); 

// PHP possède un système de "nettoyage automatique" des fichiers de session sur le serveur par le procédé du "GC" - "Garbage Collection"
// En gros, à chaque opération sur les sessions serveur, il y a une petite probabilité que l'opération de nettoyage se lance et supprimer tous les fichiers de sessions expirés du serveur 


// exemple de gestion de session pour connexion et deconnexion 

// CONNEXION
// Si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simuler une vérification des identifiants
    if ($username === 'admin' && $password === '1234') {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user']['name'] = $username;
        $_SESSION['logged_in'] = true;
        echo "Connexion réussie, bienvenue $username !";
    } else {
        echo "Identifiants incorrects.";
    }
}

// Si l'utilisateur est connecté, afficher un message de bienvenue
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "<p>Bienvenue, " . $_SESSION['username'] . "</p>";
    echo '<a href="logout.php">Déconnexion</a>';
}



// Cas d'usage typiques de $_SESSION

//     Connexion utilisateur : Conserver des informations utilisateur pendant toute la durée de leur navigation (nom, rôle, etc.).
//     Panier d'achat : Sauvegarder temporairement des articles sélectionnés par l'utilisateur avant un achat.
//     Gestion des états de formulaire : Sauvegarder des données d'un formulaire en plusieurs étapes.


// Bonnes pratiques avec $_SESSION

//     Protéger les données sensibles : Ne jamais stocker des informations sensibles directement dans $_SESSION, telles que des mots de passe. Utiliser des ID et des références indirectes.
//     Sécuriser les sessions : Utiliser session_regenerate_id() lors de changements d'état sensibles (comme après une connexion) pour éviter les attaques de fixation de session.
//     Limiter la durée de vie des sessions : Définir une expiration de session pour éviter que des sessions restent actives trop longtemps.
