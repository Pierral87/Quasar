<?php
session_start();

// Suppression du panier
if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Le panier a été vidé.";
    header('Location: exoPanier.php');
    exit;
}

// Suppression d'un produit
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        $_SESSION['message'] = "Le produit a été supprimé du panier.";
    }
    header('Location: exoPanier.php');
    exit;
}

// Modification des quantités
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    // var_dump($_POST);
    foreach ($_POST['quantities'] as $productId => $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = intval($quantity);
        }
    }
    $_SESSION['message'] = "Le panier a été mis à jour.";
    header('Location: exoPanier.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Votre Panier</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Affichage panier -->
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <form action="exoPanier.php" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $productId => $product): 
                            $subtotal = $product['price'] * $product['quantity'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price'] ?>€</td>
                                <td>
                                    <input type="number" name="quantities[<?= $productId ?>]" value="<?= $product['quantity'] ?>" min="1" class="form-control" style="width: 80px;">
                                </td>
                                <td><?= number_format($subtotal, 2) ?>€</td>
                                <td>
                                    <a href="exoPanier.php?action=remove&id=<?= $productId ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong><?= number_format($total, 2) ?>€</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" name="update_cart" class="btn btn-warning">Mettre à jour le panier</button>
            </form>

            <a href="exoPanier.php?action=clear" class="btn btn-danger mt-3">Vider le panier</a>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>

        <a href="exoIndex.php" class="btn btn-primary mt-3">Continuer vos achats</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


