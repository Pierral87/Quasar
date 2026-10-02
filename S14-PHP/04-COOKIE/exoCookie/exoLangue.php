<?php

// var_dump($_SERVER);

/*

    EXERCICE COOKIE :
            Mémorisation d'un choix de langue par l'utilisateur : 

                Etapes : 
                    - 1 Créer 4 liens HTML représentant des langues 
                    - 2 Via le GET, transmettre les informations de la langue cliquée
                    - 3 En fonction de la langue cliquée, créer un cookie correspondant
                    - 4 Vérifier le fonctionnement en revenant sur la page pour voir si la langue a été mémorisée (afficher la langue sélectionnée ou une phrase dans la langue en question)
                    - 5 Bien faire en sorte que le choix de langue soit cohérent (quelle serait la priorité entre le cookie, le choix utilisateur, le choix par défaut)

*/ 



if (isset($_GET['langue'])) {
    $langue = $_GET['langue'];
    setcookie('langue', $langue, time() + 365 * 24 * 3600, "/"); // Cookie valide pour un an
    header('Location: '.$_SERVER['PHP_SELF']); // Actualisation de la page après le choix de la langue
    exit;
}

// Vérification du cookie
// On pourrait supposer ici, se servir de la langue du navigateur plutôt que d'imposer une langue par défaut
// On peut trouver cette information dans $_SERVER  qui est une superglobale regroupant des informations navigateur et serveur
// On y trouve un indice HTTP_ACCEPT_LANGAGE qui nous indique toutes les langues activées sur le navigateur
// Il nous suffit ensuite de découper les deux premiers caractères (avec substr par exemple) pour récupérer le code langue et ainsi s'en servir dans notre code 

$langue = isset($_COOKIE['langue']) ? $_COOKIE['langue'] : 'fr';
setcookie('langue', $langue, time() + 365 * 24 * 3600); 

$phrases = [
    'fr' => 'Bonjour, bienvenue sur notre site.',
    'en' => 'Hello, welcome to our website.',
    'es' => 'Hola, bienvenido a nuestro sitio.',
    'it' => 'Ciao, benvenuto nel nostro sito.',
    'jp' => 'こんにちは、私たちのサイトへようこそ。'
];

$langueAffichage = [
    'fr' => 'Français',
    'en' => 'Anglais',
    'es' => 'Espagnol',
    'it' => 'Italien',
    'jp' => 'Japonais'
];

$message = $phrases[$langue];
$langueSelectionnee = $langueAffichage[$langue];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de la langue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Choisissez votre langue</h1>
    <div class="d-flex justify-content-between align-items-center">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Langues
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="?langue=fr">Français</a></li>
                <li><a class="dropdown-item" href="?langue=en">Anglais</a></li>
                <li><a class="dropdown-item" href="?langue=es">Espagnol</a></li>
                <li><a class="dropdown-item" href="?langue=it">Italien</a></li>
                <li><a class="dropdown-item" href="?langue=jp">Japonais</a></li>
            </ul>
        </div>

        <div class="alert alert-info mb-0">
            Langue sélectionnée : <strong><?= $langueSelectionnee ?></strong>
        </div>
    </div>
    
    <div class="mt-4 p-3 bg-light border">
        <h2>Message :</h2>
        <p><?= $message ?></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
