<?php

/* 

Exercice 3 : Gérer une simulation d'un mode de paiement via des classes, traits et interfaces


Énoncé :

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utiliser un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter, on le use dans la class Paiement.
    Dans une des classes (par exemple PaiementCarte), empêchre la surcharge d'une méthode en la marquant comme final.

    */

interface PaiementInterface 
{
    public function executerPaiement();
}

trait ValidationPaiement 
{
    public function valider()
    {
        return "<hr>Paiement validé !<hr>";
    }
}

abstract class Paiement implements PaiementInterface 
{

    use ValidationPaiement;

    public function __construct(protected float $montant)
    {
        $this->montant = $montant;
    }

    abstract public function traiterPaiement();

    public function executerPaiement() 
    {
        echo $this->valider();
        return $this->traiterPaiement();
    }
}

class PaiementCarte extends Paiement 
{
    public function traiterPaiement()
    {
        return "Paiement de $this->montant € par carte<br>";
    }
}

class PaiementVirement extends Paiement 
{
    public function traiterPaiement()
    {
        return "Paiement de $this->montant € par virement<br>";
    }
}

$carte = new PaiementCarte(100);
echo $carte->executerPaiement();

$virement = new PaiementVirement(100);
echo $virement->executerPaiement();