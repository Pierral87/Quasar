<?php

/* 

Exercice 2 : Gestion de Panier avec static et const

Objectif : Créer un système simple de gestion de panier avec une classe Panier qui utilise des propriétés et méthodes statiques pour gérer le nombre total de produits et des constantes pour définir des paramètres spécifiques au panier.

Énoncé :

    Créez une classe Panier qui contiendra :
        Une constante MAX_ITEMS qui définira le nombre maximum d'articles dans le panier.
        Une propriété statique $totalItems qui contiendra le nombre total d'articles.
        Une méthode statique ajouterProduit($quantite) qui permet d'ajouter un produit au panier (en respectant la limite définie par MAX_ITEMS).
        Une méthode statique afficherTotal() qui affiche le nombre total d'articles dans le panier.

        */

class Panier
{

    public const MAX_ITEMS = 30;

    public static $totalItems = 0;

    public static function ajouterProduit(int $quantite)
    {
        if ($quantite <= 0) {   // Il faut forcément ajouter une quantité positive
            return "Vous devez ajouter au moins 1 produit au panier.";
        }

        if ($quantite > self::MAX_ITEMS) { // Quantité supérieure au max autorisé
            return "Veuillez réduire le nombre de produits que vous souhaitez ajouter !";
        }

        if (self::$totalItems == self::MAX_ITEMS) { // Quantité max déjà atteinte 
            return "Vous avez atteint la limite de produits. Vous ne pouvez plus en ajouter.";
        } else { // Sinon... On calcule
            self::$totalItems += $quantite; // On ajoute la quantité
            $surplus = self::$totalItems - self::MAX_ITEMS; // On vérifie si on a du surplus qui dépasse la quantité max autorisé

            if ($surplus > 0) { // S'il y a un surplus
                self::$totalItems -= $surplus; // On réduit la quantité de produit au max autorisé en indiquant au user qu'on lui a enlevé un certains nombre de produits 
                return $surplus . " produits n'ont pas pu être ajoutés au panier car il a atteint sa capacité max.";
            } else { // Sinon, c'est ok 
                return $quantite . " produits ont correctement été ajoutés au panier.";
            }
        }
    }

    public static function afficherTotal()
    {
        return "Vous avez " . self::$totalItems . " produits dans votre panier.";
    }
}

echo Panier::MAX_ITEMS . "</br>";
echo Panier::$totalItems . "</br>";


echo Panier::ajouterProduit(10);
echo "</br>";
echo Panier::afficherTotal();
echo "<hr>";
echo Panier::ajouterProduit(15);
echo "</br>";
echo Panier::afficherTotal();
echo "<hr>";
echo Panier::ajouterProduit(40);
echo "<hr>";
echo Panier::ajouterProduit(15);
echo "</br>";
echo Panier::afficherTotal();
echo "<hr>";
echo Panier::ajouterProduit(10);
echo "<hr>";
echo Panier::ajouterProduit(-5);
