<?php 
/*
// Chiffrer un fichier via OpenSSL et le terminal 

// Installation de OpenSSL, via setup sur diverse distribution : 
- https://slproweb.com/products/Win32OpenSSL.html 
- https://thesecmaster.com/blog/procedure-to-install-openssl-on-the-windows-platform


// Sur Mac via homebrew 
- https://brew.sh/
- https://formulae.brew.sh/formula/openssl@3

// Sur Linux, à la mano
sudo apt update
sudo apt install openssl

// Documentation openssl : https://docs.openssl.org/master/

// Documentation openssl pour l'outil de cryptage : https://docs.openssl.org/master/man1/openssl-enc/#synopsis

// Vous allez peut être devoir définir une variable d'environnement système 
// OPENSSL_CONF 
    // chemin d'accès (pour moi)  : C:\wamp64\bin\apache\apache2.4.59\conf\openssl.cnf


// Exercice 01 - Chiffrer et déchiffrer un fichier .txt en ligne de commande 

    Etapes : 

        1 - Créez un fichier confidentiel.txt contenant un message.
        2 - Chiffrez avec la commande openssl enc -e   (plusieurs options sont à définir, à votre propre choix, un algorithme de cryptage, il faut aussi indiquer le fichier -in et le fichier -out)
        3 - Déchiffrer avec openssl enc -d 


      Solutions : 
        Cryptage :
        openssl enc -e -aes-256-cbc -in confidentiel.txt -out confidentiel_chiffre.txt -pbkdf2 -iter 10000

        Decryptage : 
        openssl enc -d -aes-256-cbc -in confidentiel_chiffre.txt -out confidentiel_dechiffre.txt -pbkdf2 -iter 10000

1. -pbkdf2

    Signification : Utilise l'algorithme PBKDF2 (Password-Based Key Derivation Function 2) pour dériver une clé à partir d'un mot de passe.
    Pourquoi l'utiliser ? PBKDF2 applique un processus de dérivation qui inclut des itérations et un "salt" (aléatoire), rendant les attaques par force brute ou les attaques par dictionnaire beaucoup plus difficiles.
    Par défaut : Sans -pbkdf2, OpenSSL utilise une méthode de dérivation moins sécurisée et désormais obsolète.

2. -iter

    Signification : Définit le nombre d'itérations utilisées par PBKDF2 pour dériver la clé.
    Pourquoi l'utiliser ? Plus le nombre d'itérations est élevé, plus le processus de dérivation est lent, rendant les attaques encore plus coûteuses pour un attaquant.
    Exemple courant : -iter 10000 signifie que PBKDF2 sera appliqué 10 000 fois.
    Recommandation : Utilisez un nombre d'itérations suffisamment élevé pour un bon équilibre entre sécurité et performances (10 000 est un bon point de départ).
*/