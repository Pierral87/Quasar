<?php 

/* 

Les cookies sont des petits fichiers de données que les serveurs Web stockent sur l'ordinateur d'un utilisateur via le navigateur. Ils permettent aux applications web de conserver des informations d'une session à une autre, telles que les préférences d'un utilisateur ou les informations de session, même après la fermeture du navigateur ou la déconnexion de l'utilisateur. En PHP, les cookies sont gérés via la superglobale $_COOKIE.
Utilisation des cookies en PHP

    Stockage d'informations à long terme : Contrairement à $_SESSION qui stocke des données côté serveur et expire lorsqu'un utilisateur ferme son navigateur, un cookie peut persister plus longtemps (jours, mois ou années) selon la durée de vie que tu définis.
    Personnalisation : Ils peuvent être utilisés pour enregistrer des préférences, comme la langue d'affichage ou le thème, et ainsi améliorer l'expérience utilisateur lors des prochaines visites.
    Suivi utilisateur : Ils permettent de suivre les utilisateurs d'une page à l'autre, voire d'un site à l'autre (ce que font les publicités ciblées).

Syntaxe et manipulation des cookies en PHP
1. Création d'un cookie :

Pour créer un cookie en PHP, on utilise la fonction setcookie(). Elle doit être appelée avant tout contenu HTML, car les cookies sont envoyés dans l'en-tête HTTP.

// setcookie(name, value, expire, path, domain, secure, httponly);

name : Nom du cookie (obligatoire).
value : Valeur du cookie (obligatoire).
expire : Timestamp de la date d'expiration. Par défaut, un cookie expire à la fermeture du navigateur, mais tu peux le rendre persistant.
path : Chemin sur le serveur où le cookie sera accessible. Par défaut, il est accessible sur toute l'application.
domain : Domaine pour lequel le cookie est valable. Par exemple, .mon-site.com rendrait le cookie accessible sur tous les sous-domaines.
secure : Si défini à true, le cookie sera envoyé uniquement via HTTPS.
httponly : Si défini à true, le cookie ne sera pas accessible via JavaScript (protection contre les attaques XSS).

// setcookie("username", "PierreAlexandre", time() + 3600, "/", "", false, true);
Ici, un cookie nommé username est défini avec la valeur "PierreAlexandre" et une durée de vie d'une heure (3600 secondes).

2. Lecture d'un cookie :

Les cookies déjà définis peuvent être lus via la superglobale $_COOKIE.

if (isset($_COOKIE['username'])) {
    echo "Bonjour, " . htmlspecialchars($_COOKIE['username']);
} else {
    echo "Bienvenue, visiteur anonyme.";
}


3. Suppression d'un cookie :

Pour supprimer un cookie, tu dois l'expirer en définissant une date passée :
setcookie("username", "", time() - 3600, "/");
Cela définit une durée de vie expirée, ce qui provoque la suppression du cookie par le navigateur.

Contexte d'utilisation des cookies

    Connexion automatique : Les cookies peuvent mémoriser les informations de connexion d'un utilisateur pour qu'il n'ait pas à se reconnecter à chaque visite.
    Personnalisation : Les préférences de langue, de thème ou de paramètres sont souvent stockées dans des cookies pour que le site s'adapte automatiquement à l'utilisateur.
    Suivi des utilisateurs : Les cookies sont utilisés pour suivre les sessions utilisateurs ou les habitudes de navigation (souvent pour la publicité ciblée).

*/

if(isset($_COOKIE['theme'])) {
    $theme = htmlspecialchars($_COOKIE['theme']);
    setcookie("theme", $theme, time() + (60 * 60 * 24 * 365 * 2));
} else {
    $theme = "clair";
    setcookie("theme", $theme, time() + (60 * 60 * 24 * 365 * 2));
}

if(isset($_GET["theme"])) {
    $selectedTheme = $_GET["theme"];
    setcookie("theme", $selectedTheme, time() + (60 * 60 * 24 * 365 * 2));
    // Rechargement de la page pour appliquer immédiatement le changement de thème
    header("Location: introCookie.php");
    exit;
}

// $theme = "clair";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: <?= $theme === 'sombre' ? '#333' : '#fff'; ?>; color: <?= $theme === 'sombre' ? '#fff' : '#000'; ?>;">
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light <?= $theme === 'clair' ? 'disabled' : ''; ?>">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark <?= $theme === 'sombre' ? 'disabled' : ''; ?>">Thème Sombre</a>
        </p>
        <p>Thème actuel : <strong><?= ucfirst($theme) ?></strong></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>