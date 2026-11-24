<?php 

/*

    Surcharge / Override 

    La surcharge est le concept qu'une classe enfant réécrive une méthode héritée de la classe parente afin de modifier son comportement 

*/

class Animal
{
    public string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer()
    {
        echo "$this->nom se déplace";
    }

}

class Oiseau extends Animal 
{
    public function seDeplacer() // On redéfinit la méthode seDepalcer, on est en train de mettre en place une surcharge/override
    {
        echo "$this->nom vole dans les airs.<br>"; // On écrase ici la méthode d'origine pour appliquer un nouveau traiement 
        echo parent::seDeplacer(); // Il nous est toujours possible de réatteindre la méthode parent grâce à la syntaxe parent:: 
    }
}

$oiseau = new Oiseau("Roucoul");

$oiseau->seDeplacer();