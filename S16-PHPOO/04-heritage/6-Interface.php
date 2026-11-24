<?php 

/*

    Une interface est une structure qui définit un ensemble de méthodes vides ! 
        En implémentant une interface on oblige la classe qui l'implémente à définir les méthodes en question 

        L'avantage des interfaces est qu'on peut en implémenter plusieurs à la fois ! Contrairement à l'héritage d'une classe abstract qui est limitée à l'héritage d'une seule classe 

*/

interface AnimalInterface 
{
    // public string $nom; // Pas de props autorisées sur les interfaces (sauf hooked properties voir note php 8.4)

    public function communiquer();

}

interface Mammifere 
{
    public function metBas();
}

class Chien implements AnimalInterface, Mammifere
{
    public function communiquer() 
    {
        echo "L'animal communique";
    }

    public function metBas()
    {
        echo "Hop, un bébé chien";
    }
}