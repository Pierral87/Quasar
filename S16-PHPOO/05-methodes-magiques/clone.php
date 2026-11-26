<?php 

class Ecole 
{
    public $nom = "CloudCampus";
    public $ville = "Paris";

    public function __clone()
    {
        // Un clone peut se faire sans forcément définir la méthode magique, mais si elle existe alors le code qu'on exécute ici s'appliquera au nouvel objet créé.
        $this->nom = "Nouveau nom après clonage dans la méthode magique";
    }
}

$ecole1 = new Ecole;
$ecole2 = new Ecole;
$ecole2->ville = "Tokyo";

var_dump($ecole1);
var_dump($ecole2);

$ecole3 = $ecole1; // Lorsque je fais ça, je pense peut être faire une copie d'un élément pour créer un nouvel objet MAIS NON ! EN fait je créer ici simplement une nouvelle variable ecole3 représentant le MEME objet que ecole1 (je le vois grâce aux id des objets avec var_dump), donc lorsque j'appelle ecole3 ou ecole1 en fait on parlera toujours du même objet #1 
// On peut parfois avoir des incohérences en cours de développement avec ce genre de problématique, notamment lorsqu'il existe des patterns de limitation d'instanciation d'objet, tel que le pattern Singleton 

$ecole4 = clone($ecole1); // Grâce à l'instruction clone, je dédouble l'objet pour en créer un nouveau, $ecole4 (mais en fait l'objet id3), est un nouvel objet qui a pris en copie les valeurs des props de $ecole1 (objet id1)
// $ecole4->nom = "Nuage Campus";
$ecole4->ville = "Nuage sur Ciel";


$ecole3->nom = "Pierra Formation";
var_dump($ecole3);
var_dump($ecole4);

echo "<h2>Récap des écoles : </h2><br>";
echo "<b>Ecole 1 : </b> $ecole1->nom à $ecole1->ville <hr>";
echo "<b>Ecole 2 : </b> $ecole2->nom à $ecole2->ville <hr>";
echo "<b>Ecole 3 : </b> $ecole3->nom à $ecole3->ville <hr>";
echo "<b>Ecole 4 : </b> $ecole4->nom à $ecole4->ville <hr>";

$ecole1->ville = "Osaka";
echo "<h2>Récap des écoles : </h2><br>";
echo "<b>Ecole 1 : </b> $ecole1->nom à $ecole1->ville <hr>";
echo "<b>Ecole 2 : </b> $ecole2->nom à $ecole2->ville <hr>";
echo "<b>Ecole 3 : </b> $ecole3->nom à $ecole3->ville <hr>";
echo "<b>Ecole 4 : </b> $ecole4->nom à $ecole4->ville <hr>";
