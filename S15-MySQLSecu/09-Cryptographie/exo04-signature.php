<?php 

/*

Contexte

Le principe de signature numérique est souvent utilisé avec des fichiers. Voici le processus :

    Création de la signature :
    On génère une signature à partir du contenu du fichier avec une clé privée.

    Stockage :
    La signature est généralement sauvegardée dans un fichier séparé ou transmise avec le fichier original.

    Vérification :
    À l'arrivée, l'utilisateur récupère le fichier original et la signature. Avec la clé publique associée, il vérifie que la signature correspond bien au contenu.

Si le contenu est modifié, la vérification échoue.

        EXERCICE : Signature d'un fichier 

        Etapes : 
            - Réutiliser les clés privée/publique de l'exercice précédent 
            - Ajouter un document pdf quelconque à votre dossier
            - Créer une signature avec openssl_sign 
            - Enregistrer la signature dans un fichier 
            - Afficher un message 

            - Créez un dossier à l'intérieur du dossier exercices 
            - Ajouter une copie de votre doc pdf et du fichier contenant la signature dans ce dossier
            - Récupérer la clé publique de l'exercice précédent ainsi que la signature qui a été créée par le premier fichier 
            - Faire une vérification du document de la signature avec openssl_verify
            - Afficher un message pour indiquer que la signature est valide ou invalide

*/

// Charger la clé privée
$privateKey = file_get_contents('private_key.pem');

// Chemin du fichier à signer
$fileToSign = 'document.pdf';

// Lire le contenu du fichier
$fileContent = file_get_contents($fileToSign);

// Créer une signature
openssl_sign($fileContent, $signature, $privateKey, OPENSSL_ALGO_SHA256);

// Enregistrer la signature dans un fichier séparé
try {
    file_put_contents('document.pdf.signature', base64_encode($signature));
    echo "Signature créée et sauvegardée dans 'document.pdf.signature'.\n";
} catch (Exception $e) {
    echo "Problème de signature";
}


