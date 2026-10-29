<?php

/*

    EXERCICE Chiffrement de données sensibles et hash du password :

        Etapes : 
            - Reprendre l'exercice POST Inscription Utilisateur du dossier PHP - Chapitre Post - Exercices
            - Modifier le code pour le faire correspondre à une réelle insertion en bdd (base "crypto"  table "membre"  id_membre, pseudo, email, password)
            - Bien gérer la vérification du doublon en table
            - Gérer la sécurité de l'insertion
            - Hacher le password avec password_hash et en choisissant un algorithme puissant
            - Chiffrer l'email via un chiffrement symétrique 
                - Création d'une clé (en base64) en utilisant openssl rand en command line, la stocker dans un fichier
                - Penser à décoder cette clé de base64 avant de la manipuler dans le reste du code base64_decode
                - Créer un IV aléatoire en cumulant random_bytes() puis openssl_cipher_iv_length()
                - Crypter ensuite la donnée avec openssl_encrypt() en appliquant bien l'IV
                - La retransformer en base64 avant de la stocker base64_encode
            - Insérer en BDD 
            - Lorsque tout est OK et que l'insertion s'effectue convenablement (vérifier les données dans PHPMyAdmin, password hash et email chiffré), mettre en place une redirection vers une page indiquant à l'utilisateur qu'il est convenablement incrit, et lui respécifier son email (il faudra le dechiffrer)
                - Redécoder de base64 l'email récupéré en BDD
                - A partir de là, la chaine récupérée contient l'IV en debut de chaine (celui appliqué au chiffrement, il va falloir le découper avec substr pour extraire à la fois l'iv et à la fois le reste de la chaine cryptée)
                - Une fois la découpe des deux éléments faites, utiliser openssl_decrypt  pour déchiffrer la donnée 


            Création de clés : 
             Création d'une clé symétrique : openssl rand -base64 32 > keyfile.key

            - openssl rand : Génère des données aléatoires.
            - -base64 : Encode la clé en base64 pour faciliter son stockage ou son transfert.
            - 32 : Génère une clé de 32 octets (256 bits), idéale pour un algorithme comme AES-256.
            - > keyfile.key : Enregistre la clé générée dans un fichier nommé keyfile.key.

    */