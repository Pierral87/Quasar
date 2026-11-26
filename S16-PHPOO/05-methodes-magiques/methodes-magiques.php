<?php 
// #[\AllowDynamicProperties]

/* 

    Les Méthodes Magiques en PHP 
    Les méthodes magiques sont des fonctions spéciales en PHP que l'on écrit toujours commençant par "__"
    Elles permettent d'intercepter certaines opérations et se lancent sur des scénarios bien précis.
    Dès lors que le scénario survient, le code défini dans la méthode s'exécute ! Libre à nous d'exécuter le code de notre choix 

1. __construct() : Le constructeur
Le constructeur est une méthode appelée automatiquement lors de la création d'une nouvelle instance d'une classe. Elle est utilisée pour initialiser les propriétés d'un objet.

2. __destruct() : Le destructeur
Le destructeur est appelé automatiquement lorsque l'objet est détruit ou lorsque le script se termine. Il peut être utilisé pour effectuer des actions de nettoyage, comme la fermeture d'une connexion à une base de données.

3. __get() et __set() : Accéder et modifier des propriétés non définies
Ces méthodes permettent de gérer dynamiquement l'accès aux propriétés d'une classe qui ne sont pas directement définies.
    __get($nom) : Est invoqué lorsqu'on tente d'accéder à une propriété qui n'existe pas.
    __set($nom, $valeur) : Est appelé lorsqu'on essaie de définir une propriété qui n'existe pas.

4. __call() et __callStatic() : Appel de méthodes non définies
Ces méthodes magiques sont déclenchées lorsque l'on appelle une méthode inexistante dans une classe.
    __call($nom, $arguments) : Pour les méthodes d'instance.
    __callStatic($nom, $arguments) : Pour les méthodes statiques.

5. __toString() : Conversion d'un objet en chaîne de caractères
Cette méthode est appelée lorsqu'un objet est utilisé comme une chaîne de caractères (par exemple, avec echo ou print).

*/

class Societe
{
    public string $adresse;
    public string $ville;
    public string $cp;

    public function __construct()
    {
        echo "<b>Ici c'est le construct ! Je me lance direct à l'instanciation !</b><br>";
        // Déjà vu au chapitre 2, il se lance très l'instanciation de l'objet
    }

    public function __destruct()
    {
        echo "<b>Ici c'est le destruct ! </b><br>";
        // Le destruct est appelé automatiquement quand l'objet est détruit (fin du script)
    }

    public function __set($nom, $valeur) // Se déclenche en cas de tentative d'affectation sur une prop non existante 
    {
        echo "Attention, vous tentez de faire une affectation dans la prop nommée : $nom, donc la valeur : $valeur n'a pas été affectée ! <hr>";
    }

    public function __get($nom)
    {
        echo "Attention, vous tentez d'appeler une prop qui n'existe pas, la prop : $nom<hr>";
    }
}

echo "<h3>Debut de la page et des affichages </h3>";

$soc = new Societe;

$soc->ville = "Tokyo";
$soc->cp = "173880";

$soc->nom = "Konami";

var_dump($soc);

echo $soc->nom;



echo "<h3>Fin de la page, dernier affichage </h3>";