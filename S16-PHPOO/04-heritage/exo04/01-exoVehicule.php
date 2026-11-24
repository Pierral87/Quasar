<?php


/*

       Exercice 1 : 
        Modifier le code des classes et mettre en place les héritages pour répondre aux questions ci-dessous : 

    1. Faire en sorte de ne pas avoir d'objet Vehicule 
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer() 
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base 
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base
    6. Effectuer les affichages nécessaires pour tester

*/

class Vehicules 
{
    public function demarrer()
    {
        return "Je démarre";
    }

    public function carburant() 
    {
        return "Peut être essence, peut être diesel";
    }

    public function nombreDeTestsObligatoires()
    {
        return 100;
    }
}

class Peugeot 
{

}

class Renault 
{
    
}

