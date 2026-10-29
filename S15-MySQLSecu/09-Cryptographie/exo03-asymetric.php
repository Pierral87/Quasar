<?php 

/*

    EXERCICE : Chiffrement asymetrique sur un string

        Etapes : 
            - Créer une paire de clé privée/publique via la command line 
                openssl genpkey -algorithm RSA -out private_key.pem -pkeyopt rsa_keygen_bits:2048
openssl rsa -pubout -in private_key.pem -out public_key.pem
            - Définir une var contenant un string
            - Utiliser openssl_public_encrypt pour chiffrer dans la clé publique
            - Afficher la donnée cryptée (ne pas oublier de rencoder en base64)
            - Déchiffrer la donnée avec openssl_private_decrypt (sans oublier de la rencoder depuis base64)

*/