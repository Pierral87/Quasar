<?php 

/* 

1. Héritage simple

L'héritage est un concept clé de la programmation orientée objet, permettant de créer des classes dérivées qui héritent des propriétés et méthodes d'une classe parente. Cela permet de réutiliser du code et d'ajouter des fonctionnalités supplémentaires dans les classes enfants.

Dans cet exemple, la classe Chien hérite de la classe Animal, et bénéficie donc des propriétés et méthodes de celle-ci. La classe enfant peut également avoir ses propres méthodes, comme aboyer().

 Attention à respecter un contexte cohérent dans l'héritage
    C'est à dire : Il faut pouvoir dire que A est un B 
        un bateau est un vehicule
        un chien est un animal 
        un admin est un user
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

    // protected function manger()
    // {
    //     echo "$this->nom mange";
    // }

    // private function dormir()
    // {
    //     echo "$this->nom dort";
    // }
}

class Chien extends Animal // extends est le mot clé qui permet de définir un héritage entre deux classes, ici Chien hérite de Animal et donc "reçoit" ses props et méthodes pour peu qu'elles soient public ou protected  (le private ne transite pas à l'héritage)
{
    // public function nutrition()
    // {
    //     $this->manger();
    // }

    // public function repos()
    // {
    //     $this->dormir();
    // }

    public function aboyer() 
    {
        echo "$this->nom aboie : Wanwan!";
    }
}

class Chat extends Animal // extends est le mot clé qui permet de définir un héritage entre deux classes, ici Chat hérite de Animal et donc "reçoit" ses props et méthodes tant qu'elles sont public ou protected (on ne récupère pas le private) 
{
    public function miauler()
    {
        echo "$this->nom miaule : Nyanyan";
    }
}

$chien = new Chien("Pilou");
$chien->seDeplacer();
// $chien->nutrition();
// $chien->repos();
var_dump($chien);

$chat = new Chat("Miaouss");
var_dump($chat);
$chat->seDeplacer();