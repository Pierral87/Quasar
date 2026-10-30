<?php 

/*

Explications :

    Le fichier à vérifier (document.pdf) et sa signature (document.pdf.signature) sont lus.
    La fonction openssl_verify compare :
        Le contenu du fichier.
        La signature fournie.
        La clé publique associée.
    Si la signature est valide, cela signifie que le fichier n'a pas été modifié et qu'il provient bien du propriétaire de la clé privée.

*/


// Charger la clé publique
$publicKey = file_get_contents('../public_key.pem');

// Chemin du fichier à vérifier
$fileToVerify = 'document.pdf';

// Chemin de la signature associée
$signatureFile = 'document.pdf.signature';

// Lire le contenu du fichier et la signature
$fileContent = file_get_contents($fileToVerify);
$signature = base64_decode(file_get_contents($signatureFile));

// Vérifier la signature
$isVerified = openssl_verify($fileContent, $signature, $publicKey, OPENSSL_ALGO_SHA256);

echo $isVerified === 1 ? "Signature valide.\n" : "Signature invalide ou erreur.\n";
?>