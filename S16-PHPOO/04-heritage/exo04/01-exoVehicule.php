<?php


/*

       Exercice 1 : 
        Modifier le code des classes et mettre en place les héritages pour répondre aux questions ci-dessous : 

    1. Faire en sorte de ne pas avoir d'objet Vehicule (abstract sur Vehicules)
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer() (final sur la méthode demarrer)
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (abstract sur carburant et redéfinition dans les sous classes)
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base (override methode nombre de test et appel parent::)
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base
    6. Effectuer les affichages nécessaires pour tester

*/

abstract class Vehicules
{
    final public function demarrer()
    {
        return "Je démarre";
    }

    abstract public function carburant();

    public function nombreDeTestsObligatoires()
    {
        return 300;
    }
}

class Peugeot extends Vehicules
{
    public function carburant()
    {
        return "diesel";
    }

    #[Override]   // Ici annotation PHP, commentaire spécifique indiquant une info importante, une annotation PHP peut parfois avoir un fonctionnement spécifique (par exemple les Routes de Symfony)
    public function nombreDeTestsObligatoires()
    {
        return parent::nombreDeTestsObligatoires() + 70;
    }
}

class Renault extends Vehicules
{
    public function carburant()
    {
        return "diesel";
    }

    public function nombreDeTestsObligatoires()
    {
        return parent::nombreDeTestsObligatoires() + 30;
    }
}
