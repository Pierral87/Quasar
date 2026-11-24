<?php 

/* 

    Finalisation des classes et méthodes 

    Le mot clé final peut être utilisé pour empecher l'héritage d'une classe ou la surcharge d'une méthode.

    Classe finale : Une classe marquée comme final ne peut pas être extends
    Méthode finale : Une méthode marquée comme final ne peut pas être override dans les classes filles 

    On utilise pour final pour préserver un comportement prévu à l'origine, soit d'une simple méthode, ou parfois d'une classe entière 

*/

class Animal
{
    public string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    final public function seDeplacer()
    {
        echo "$this->nom se déplace";
    }

}

$animal = new Animal("UnAnimal");
$animal->seDeplacer();

final class Chien extends Animal 
{
    public function seNourrir()
    {
        echo "$this->nom se nourrit";
    }

    // public function seDeplacer(){} // Impossible de surcharger la méthode seDeplacer ! Elle est finale ! On veut préserver son comportement d'origine 
}

// class Labrador extends Chien {} // On ne peut pas extends d'une classe finale ! Car idem, on veut préserver son comportement (à la classe entière, pas d'autres héritages qui amèneraient des spécificités)

$chien = new Chien("Pilou");
$chien->seDeplacer();
$chien->seNourrir();