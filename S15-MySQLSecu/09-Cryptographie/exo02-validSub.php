<?php 

try {
    $host = 'mysql:host=localhost;dbname=cryptotest'; // hôte + bdd
    $login = 'root'; // login
    $password = ''; // mdp
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gestion des erreurs
    );

 

    // Création de l'objet :
    $pdo = new PDO($host, $login, $password, $options);
} catch (Exception $e) {
    die("Site hors service");
}
$pseudo = $_GET["pseudo"];
$encryptedData = $pdo->query("SELECT email FROM membre WHERE pseudo = '$pseudo'")->fetch();


// Déchiffrement
$keyPath = 'keyfile.key'; // Chemin vers le fichier contenant la clé
$key = base64_decode(trim(file_get_contents($keyPath))); // Lire et décoder la clé
if ($key === false) {
    die("Problème d'inscription");
}

// Ici c'est la récupération de l'email chiffré que l'on decode en binaire
$decodedData = base64_decode($encryptedData["email"]);

// Ci dessous on extrait l'iv de la chaine chiffré
$iv = substr($decodedData, 0, openssl_cipher_iv_length('aes-256-cbc'));

// Ci dessous on extrait la chaine chiffré sans l'iv 
$ciphertext = substr($decodedData, openssl_cipher_iv_length('aes-256-cbc'));


// Ici je déchiffre la chaine chiffrée définitivement et récupère la chaine en clair  
$decryptedData = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
echo "Voilà l'email déchiffré : $decryptedData\n";