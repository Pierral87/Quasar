<?php 


/* 

// Pour éviter les injections XSS (du code css et/ou js mis dans les commentaires)
// il est possible de modifier les carac notamment les < > qui représentent des balises.
// à l'affichage (voir en bas de page) on appelle htmlspecialchars() qui permet de transformer ces caractères problématiques en entités html
// exemple :
// <script>while(true){alert('truc');}</script>
// sera écrit dans le code source sous cette forme :
// &lt;script&gt;while(true){alert('truc');}&lt;/script&gt;

// <style>body{display:none;}</style>

// Outils proche de htmlspecialchars() : htmlentities() / strip_tags()


// Pour tester les injections, depuis le champ message 
// pour injection SQL ', ''); DROP DATABASE dialogue;
// ou 
// pour injection SQL ', NOW()); DROP DATABASE dialogue;

// Depuis le champ pseudo 
// pour injection SQL ', '', NOW()); DELETE FROM commentaire;

// ', '', NOW()); DO SLEEP(10);  injection en aveugle, permet de voir si l'injection est possible en mettant un temps de délais à la requete (on remarque le chargement, comme ça, même sans message d'erreur on peut comprendre que le système est sensible aux injections)

// Pour insérer dans un fichier.txt   la selection d'une table via injection 
// ', NOW()); SELECT * INTO OUTFILE 'c:/wamp64/tmp/fichier2.txt' FROM commentaire; #

// Pour réinsérer dans une table, le contenu d'un fichier.txt 
// ', NOW()); INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('1', LOAD_FILE('c:/wamp64/tmp/fichier2.txt'), NOW());

// Ici ok, on manipule uniquement la table commentaire et on réinsère dans la table commentaire, mais il faut bien comprendre que lorsqu'une injection est possible sur votre site, alors, l'intégralité du système et des données sont compromises ! 

// Meme si ici la requête d'origine concerne la table commentaire, rien ne nous empêche d'intéragir sur une table users, pour récupérer l'entièreté des infos des users, l'insérer dans un .txt, l'insérer dans la table commentaire, pour la rendre visible et ainsi récupérer les données privées des users...

EXERCICE :
-----------
- Création d'un espace de dialogue / de tchat

- 01 - Création de la BDD : dialogue_quasar  -- OK faites dans PHPMyAdmin
     -  Table : commentaire
     - Champs de la table commentaire :
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME
        
- 02 - Créer une connexion à cette base avec PDO
- 03 - Création d'un formulaire html permettant de poster un message
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation
- 04 - Récupération des saisies du form avec controle 
- 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
- 06 - Requete de récupération des messages afin de les afficher dans cette page
- 07 - Affichage des messages avec un peu mise en forme
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date en français
- 10 - Amélioration du css

*/


// Si je sépare les infos de config BDD dans un autre fichier
// Dans un fichier config.php
// Alors je dois include le fichier 
// require_once("config.php");
// $login = DB_LOGIN;

// Si je fais avec un config.json
// $config = json_decode(file_get_contents('config.json'), true);
// $login = $config["db_login"];
// $password = $config["db_password"];

// - 02 - Créer une connexion à cette base avec PDO
$host = "mysql:host=localhost;dbname=dialogue_quasar"; // Hote et nom de bdd 
$login = "root";
$password = ""; // sur MAMP attention, le password c'est root
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // Gestion des erreurs par EXCEPTION
);

// Création de l'objet PDO : 
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    die;
}
// var_dump($pdo);

var_dump($_POST);
$erreur = "";
$pseudo = "";
$message = "";
$req = "";
// - 04 - Récupération des saisies du form avec controle
if (isset($_POST["pseudo"], $_POST["message"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $pseudo = trim($_POST["pseudo"]);
        $message = trim($_POST["message"]);

        if(empty($pseudo) || empty($message)) {
            $erreur .= "Merci de bien remplir tous les champs";
        }

        if(iconv_strlen($pseudo) < 3) {
            $erreur .= "Le pseudo doit faire au moins 3 caractères";
        }

        if(iconv_strlen($message) < 3) {
            $erreur .= "Le message doit faire au moins 3 caractères";
        }

        if(empty($erreur)) {
            // var_dump("J'ai pas d'erreur");
            // - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
            $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";

            // Pour tester les injections je vais faire query
            // $stmt = $pdo->query($req);

            // Sinon, on fait avec prepare ! 
            $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            // $stmt->execute([':pseudo' => $pseudo, ':message' => $message]);
            $stmt->execute();
        }
}
// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$commentaires = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!-- Google font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Playfair display -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <!-- Roboto -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            * {
                font-family: 'Roboto', sans-serif;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif;
            }
        </style>

        <title>Dialogue</title>
    </head>
    <body class="bg-secondary" >
        <div class="container bg-light g-0">
            <div class='row '>
                <div class="col-12">
                    <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                    <!-- - 03 - Création d'un formulaire html permettant de poster un message -->
                    <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">
                        
                        <?php 
                        echo $req; // on affiche la requete pour voir les injections SQL 
                        ?> 
                    
                        <hr>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                        <div class="mb-3">
                            <hr>
                            <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class='row mt-5'> 
                <div class="col-12">               
                    <!-- Affichage des commentaire -->
                    <p class="w-75 mx-auto mb-3"><?php
                        // - 08 - Affichage en haut des messages du nombre de message présent dans la bdd
                        echo 'il y a : <b>' . $commentaires->rowCount() . '</b> messages';
                    ?></p>
                    <?php 
                        // - 07 - Affichage des commentaire avec un peu mise en forme
                        while($commentaire = $commentaires->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date_fr'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>';
                        }
                    
                    
                    ?>
                    
                </div>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>