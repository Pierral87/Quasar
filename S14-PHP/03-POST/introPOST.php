<?php

/*

Le protocole POST est l'un des deux principaux protocoles utilisés pour envoyer des données d'un navigateur web vers un serveur, l'autre étant GET. Contrairement à GET, qui envoie les données dans l'URL, POST les envoie dans le corps de la requête HTTP, ce qui permet de transmettre des informations plus volumineuses et plus sensibles de manière plus sécurisée.
Utilisation du protocole POST en PHP

  Transmission de données : Le protocole POST est principalement utilisé pour envoyer des données qui ne doivent pas être visibles dans l'URL ou qui contiennent beaucoup d'informations, comme :
        Formulaires contenant des informations personnelles (login, inscription, paiement).
        Téléchargement de fichiers.
        Soumission de données qui modifient un état sur le serveur (par exemple : création de compte, modification de profil, ajout d’un produit, etc.).

    Sécurisation des données :
        POST est privilégié pour l'envoi de données sensibles, car les informations ne sont pas affichées dans l'URL (contrairement à GET). Bien qu'elles ne soient pas chiffrées par défaut (sauf si un certificat SSL est utilisé), elles ne sont pas visibles par l'utilisateur dans la barre d'adresse, ce qui offre un certain degré de protection.
        C’est aussi préférable pour des données volumineuses, car il n’y a pas de limite stricte à la taille des données envoyées en POST (contrairement à GET qui est limité par la longueur maximale des URL).


Points importants à noter avec POST

    Taille des données :
        Le protocole POST permet d’envoyer des données volumineuses. Par exemple, un formulaire avec de nombreux champs ou des fichiers peut être envoyé par POST sans les restrictions liées à la longueur des URL, qui limitent GET.
        Attention cependant à la limite de taille des données définie par le serveur (variable post_max_size dans php.ini).

    Visibilité des données :
        Avec POST, les données ne sont pas affichées dans l’URL, ce qui est un avantage en termes de sécurité pour des informations sensibles comme des mots de passe ou des numéros de carte bancaire. Toutefois, il faut toujours utiliser un protocole HTTPS pour protéger les données en transit.

    Côté serveur : $_POST :
        PHP reçoit et traite les données envoyées via POST en utilisant la superglobale $_POST, un tableau associatif contenant les valeurs des champs du formulaire (ex. $_POST['name']).

Contextes d'utilisation de POST

    Formulaires d'inscription et de connexion : Lorsqu'un utilisateur soumet ses informations de connexion, il est préférable d'utiliser POST pour masquer ces informations dans l'URL.

    Enregistrement en base de données : Toute action qui modifie l’état d’une base de données (comme l’ajout, la modification ou la suppression de données) doit passer par POST. Cela garantit que les données sont envoyées en toute sécurité et n’apparaissent pas dans l'URL, ce qui évite la répétition de la requête par simple rechargement de la page.

    Téléchargement de fichiers : Le protocole POST est souvent utilisé avec des champs de type file dans les formulaires pour télécharger des fichiers depuis le client vers le serveur.

    Systèmes de paiement : Les données de paiement, telles que les informations de carte de crédit, passent généralement par POST car ces informations doivent rester privées.


    Pourquoi utiliser $_SERVER REQUEST METHOD ? 

La condition $_SERVER['REQUEST_METHOD'] === 'POST' est une manière plus robuste et précise de vérifier que la requête envoyée par le client est bien une requête POST, contrairement à un simple isset() sur les champs attendus dans $_POST.

Voici quelques raisons pour lesquelles cette méthode est souvent préférable :
1. Vérification explicite de la méthode de la requête

L’utilisation de $_SERVER['REQUEST_METHOD'] === 'POST' garantit que la requête est réellement de type POST. Cela est important parce que les formulaires peuvent théoriquement être envoyés en utilisant d’autres méthodes (GET, PUT, DELETE, etc.), et isset() ne vérifierait pas la méthode utilisée, seulement la présence des données dans $_POST.

Par exemple, si un utilisateur ou un script modifie la méthode du formulaire pour utiliser GET ou une autre méthode, isset() serait satisfait tant que les données sont présentes, mais le comportement attendu pourrait être incorrect.
2. Protection contre les accès directs à la page

En utilisant $_SERVER['REQUEST_METHOD'] === 'POST', on évite que l’accès direct à une page de traitement par l’URL (sans soumission de formulaire) ne soit interprété comme une tentative valide d’envoyer des données.

*/

var_dump($_POST);
// var_dump($_SERVER);

$content = "";

if(isset($_POST["name"], $_POST["email"], $_POST["message"]) && $_SERVER['REQUEST_METHOD'] === "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

     $content = "
    <div class='card'>
        <div class='card-header bg-primary text-white'>
            <h5>Informations reçues</h5>
        </div>
        <div class='card-body'>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong> $message</p>
        </div>
    </div>";

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>
                <form action="" method="POST" class="mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                <!-- Affichage des informations soumises -->
                <?= $content ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>