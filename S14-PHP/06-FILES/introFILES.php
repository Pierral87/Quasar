<?php

/* 

$_FILES est une superglobale de PHP ! Encore une fois un array ! 

Elle est utilisée pour récupérer les informations sur les pièces jointes envoyés par un formulaire HTML ! 

ATTENTION, il ne faut pas oublier l'attribut enctype="multipart/form-data"  dans notre balise form, sinon impossibilité de récupérer la pièce jointe 

Egalement, un input type="file" n'est pas visible dans le $_POST mais uniquement dans le $_FILES 

$_FILES est un tableau array associatif avec des clés qui représentent les informations sur notre fichier notamment le "name" pour le nom du fichier et le "tmp_name" pour le chemin vers le fichier temporaire représentant cet envoi, sur le serveur !  

"error" est un int représentant un code d'erreur, 0 pour pas d'erreur  

*/




// var_dump($_POST);
// var_dump($_FILES);

$uploadDir = "upload/";
$uploadMessage = "";

// Extensions autorisées 
$allowedExtensions = ["jpg", "jpeg", "png", "gif", "pdf"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["fichier"]) && $_FILES['fichier']["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["fichier"]["tmp_name"];
        $fileName = basename($_FILES["fichier"]["name"]);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        // var_dump($fileExtension);    

        // Vérification de l'extension du fichier 
        if (in_array($fileExtension, $allowedExtensions)) {
            $fileName = strtolower(preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName));


            // Ajout d'un identifiant unique random devant le nom du fichier pour éviter les collisions 
            $fileName = uniqid() . "_" . $fileName;
            // var_dump($fileName);

            // On définit ici le path final du fichier, c'est à dire le chemin d'accès dossier/nomdefichier 
            $destPath = $uploadDir . $fileName;

            // move_uploaded_file déplace réellement le fichier du tmp jusqu'à sa vraie position
            // Il sera ainsi sauvegardé sur le serveur
            // Si la copie fonctionne, on récupère true, sinon false 
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $uploadMessage = "<div class='alert alert-success'>Fichier envoyé avec succès !</div>";
            } else {
                $uploadMessage = "<div class='alert alert-danger'>Erreur lors de l'envoi du fichier.</div>";
            }
        } else {
            $uploadMessage = "<div class='alert alert-danger'>Extension non autorisée. Veuillez envoyer un fichier avec l'une des extensions suivantes : jpg, jpeg, png, gif, pdf.</div>";
        }
    } else {
        // Gestion des erreurs
        switch ($_FILES['fichier']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier dépasse la taille autorisée par le serveur.</div>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier dépasse la taille autorisée par le formulaire.</div>";
                break;
            case UPLOAD_ERR_PARTIAL:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier a été partiellement téléchargé.</div>";
                break;
            case UPLOAD_ERR_NO_FILE:
                $uploadMessage = "<div class='alert alert-danger'>Aucun fichier sélectionné.</div>";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $uploadMessage = "<div class='alert alert-danger'>Dossier temporaire manquant.</div>";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $uploadMessage = "<div class='alert alert-danger'>Impossible d'écrire le fichier sur le disque.</div>";
                break;
            case UPLOAD_ERR_EXTENSION:
                $uploadMessage = "<div class='alert alert-danger'>Téléchargement arrêté par une extension PHP.</div>";
                break;
            default:
                $uploadMessage = "<div class='alert alert-danger'>Erreur inconnue lors de l'envoi du fichier.</div>";
                break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Upload de fichier</h1>

                <?= $uploadMessage ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Sélectionnez un fichier à télécharger</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>