<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    foreach ($_SESSION['produits'] as $produit) {
        if ($produit['id'] == $id) {
            $produitSelectionne = $produit;
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
    <title>Détail du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row">
            <?php if (isset($produitSelectionne)) : ?>
                <div class="col-8 w-50 mx-auto">
                    <div class="card mb-3">
                        <img src="<?= $produitSelectionne['image']; ?>" class="card-img-top" alt="<?= $produitSelectionne['nom']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $produitSelectionne['nom']; ?></h5>
                            <p class="card-text"><?= $produitSelectionne['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Catégorie : <?= $produitSelectionne['categorie']; ?></small></p>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger">Produit introuvable.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>