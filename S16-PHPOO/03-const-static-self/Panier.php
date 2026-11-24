<?php 
/* 

-------------------- 1. Les Constantes

Les constantes dans une classe permettent de définir des valeurs immuables, c'est-à-dire qui ne peuvent pas être modifiées après leur définition. Contrairement aux propriétés normales, les constantes de classe (sont partagées par toutes les instances de la classe), et on y accède directement via le nom de la classe, sans avoir besoin de créer un objet.

Syntaxe :

    Les constantes sont définies avec le mot-clé const.
    Elles doivent être en majuscules par convention.


------------------ 2. Les Propriétés et Méthodes Statics

Les membres statics (propriétés et méthodes) appartiennent à la classe elle-même, et non aux objets instanciés à partir de cette classe. Cela signifie que vous pouvez accéder aux membres statics sans créer d'instance de la classe.

    Propriété static : Elle appartient à la classe et est appelée directement sur la classe.
    Méthode static : Elle appartient à la classe et est appelée directement sur la classe.

Syntaxe :

    Utilisez le mot-clé static pour déclarer une méthode ou une propriété comme étant static.
    Accédez à une propriété ou méthode static via NomDeClasse:: (ou self:: si on est dans le scope local de la classe).

------------------- 3. Le Mot-clé self

Le mot-clé self est utilisé pour accéder aux membres statics (constantes, méthodes ou propriétés) d'une classe à l'intérieur de cette même classe. 

                Différence entre self et $this :

    self : Fait référence à la classe actuelle (utilisé pour les membres statics).
    $this : Fait référence à l'instance actuelle d'un objet (utilisé pour les membres non statics).

*/

class Panier {

   const TVA = 20; // Constante, par défaut public 

    public static $totalPanier = 2;
    public $nbrProduits = 0;

    public static function afficherTotal() {
        return "Total panier : " . self::$totalPanier . "€";
    }

    public function ajouterProduit(int $prix) {
        self::$totalPanier += $prix * (1 + self::TVA / 100);
    }

}

$panier = new Panier;
// echo "totalPanier panier 1 : " . $panier->totalPanier;
// var_dump($panier);

echo Panier::$totalPanier . "<hr>";
echo Panier::afficherTotal() . "<hr>";
echo Panier::TVA;

$panier->ajouterProduit(200);

echo Panier::afficherTotal() . "<hr>";


// Tests des syntaxes PHP entre static et non static 

echo $panier->nbrProduits; // Ok normal fonctionne, contexte objet normal 
$panier->ajouterProduit(200); // Ok ça fonctionne j'appelle une méthode, contexte objet normal 
// $panier->TVA; // Erreur je ne peux pas appeler une constant dans un contexte objet non static 


// ATTENTION, les syntaxes ci dessous fonctionnent... C'est dû à la flexibilité du langage PHP, il est très permissif !  
// On n'utilisera jamais ces syntaxes là, un élément static est toujours censé être appelé sur la classe elle même et jamais sur un objet ! 
echo $panier::TVA;
echo "<br>";
echo $panier::$totalPanier;
echo "<br>";
echo $panier::afficherTotal();
echo $panier->afficherTotal();

