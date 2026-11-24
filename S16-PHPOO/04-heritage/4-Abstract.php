<?php 

/* 

    Classes abstract et methodes abstract 

    Une classe abstract ne peut pas être instanciée directement, elle sert uniquement de modèle pour d'autres classes.

    Une classe abstract contient généralement des méthodes déclarées elles aussi abstract, cela OBLIGE les classes filles à définir la méthode en question.

    Dans l'exemple ci dessous, la méthode communiquer() étant abstract, la classe Chien et Chat ont l'OBLIGATION d'implémenter cette méthode (ou bien de la définir à nouveau en abstract pour l'appliquer à un nouveau niveau d'héritage)

    L'utilisation des classes abstraites permet de fournir un cadre strict de dév ! Grâce à ça, tous les devs de l'équipe travaillant sur les classes et sous classe vont automatiquement travailler de la même manière en utilisant les bons noms de méthodes prévus par la classe principale abstract  

*/

abstract class Animals // Ici je défini ma classe étant une classe abstract, je ne peux plus l'instancier ! Je peux simplement m'en servir pour héritage 
{
    public string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer()
    {
        echo "$this->nom se déplace<br>";
    }

    abstract public function communiquer();

}

// $animal = new Animal("Titi"); // Je ne peux pas instancier une classe abstract ! Je peux uniquement m'en servir pour héritage

class Chien extends Animals 
{
    public function communiquer() 
    {
        echo "$this->nom aboie: 'Caninosssss!'<br>";
    }
}

class Chat extends Animals 
{
   public function communiquer() 
    {
        echo "$this->nom miaule: 'Miaousssss!'<br>";
    } 
}

$chien = new Chien("Caninos");
$chat = new Chat("Miaouss");

$chien->communiquer();
$chat->communiquer();