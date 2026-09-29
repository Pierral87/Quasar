<?php
/* 

Le protocole GET fait partie du protocole HTTP (Hypertext Transfer Protocol), utilisé pour récupérer des informations depuis un serveur. C'est l'une des méthodes les plus courantes pour interagir avec une application web, principalement pour demander des ressources sans modifier les données du serveur.
On peut considérer que le protocole GET réagit sur une action "clic" 


------ 1. Fonctionnement du Protocole GET
Lorsque vous envoyez une requête GET, le client (navigateur ou logiciel) envoie une demande au serveur pour une ressource spécifique. Cette demande inclut généralement :

    L'URL de la ressource demandée.
    Des paramètres de requête optionnels qui sont attachés à l'URL sous forme de paires clé-valeur.

    Structure d'une requête GET :   
        GET /page.php?param1=value1&param2=value2 

        Ici on remarquera le point d'interrogation ? qui indique que nous sommes à la fin de l'url pour ensuite ne citer que des params 

    Exemple basique :
    Le client demande une page page.php située sur le serveur www.exemple.com.
    Il transmet deux paramètres (param1=value1 et param2=value2) via l'URL.
    Le serveur renvoie ensuite la ressource demandée (souvent une page HTML) sans changer son état.


---------- 2. Cas d’utilisation courants de GET
    Récupérer des pages web Exemple classique : Lorsqu’un utilisateur tape l’URL https://www.exemple.com/index.php, une requête GET est envoyée au serveur pour obtenir la page index.php.

        Affichage sur la page variant en fonction des param de GET, (exemple : categorie, fiche produit, filtre de recherche)
        Action simple : (Modification, Suppression, Visualisation par exemple sur une page de gestion utilisateur)

    Passage de paramètres à l'URL Prenons un exemple où vous souhaitez rechercher des produits sur un site d’e-commerce :

https://www.exemple.com/recherche.php?q=ordinateur&cat=electro

Ici, la requête GET passe deux paramètres :

    q=ordinateur (recherche d'ordinateurs),
    cat=electro (catégorie électronique).

Le serveur reçoit cette requête, traite les paramètres, et retourne une page contenant les résultats de la recherche.

API publiques : Les API exposent souvent des points de terminaison qui acceptent des requêtes GET pour récupérer des données. Par exemple, pour obtenir des informations sur un utilisateur via une API, on pourrait faire :
GET /api/users/
GET /api/users/123

En PHP, les paramètres envoyés via GET peuvent être récupérés avec la superglobale $_GET[], les superglobales en PHP sont toutes des arrays qui sont présents dans tous les scopes (global et local)
Attention à la syntaxe $_NOMDELAGLOBAL (On découvrira plus tard POST, SESSION, COOKIE, FILES)
ATTENTION AUSSI on considèra toute information venant de l'utilisateur comme non fiable et non sécurisée
Pour ça, on vérifiera toujours l'intégrité des informations reçues au travers de GET, c'est à dire, on commencera toujours par un isset() de tous les champs attendus (et donc autorisés) dans nos params.
Deuxieme étape, on fera en sorte de filtrer les valeurs autorisées (par exemple ici nous avons 3 catégories, on ne veut pas lancer un traitement si la catégorie demandée par l'utilisateur ne fait pas parti des 3 existantes)

*/

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="introGET.php">Eshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="introGET.php">Accueil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catégories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?cat=info">Informatique</a></li>
            <li><a class="dropdown-item" href="?cat=emen">Electro-Menager</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?cat=vet">Vêtements</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="container pt-5">

<?php 

    var_dump($_GET);

?>
   <?php if (isset($_GET["cat"])) : ?> <h1>Liste des produits de la catégorie : <?= $_GET["cat"]?></h1>
    <?php else : ?> <h1>Choisissez une catégorie</h1>
      <?php endif; ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>