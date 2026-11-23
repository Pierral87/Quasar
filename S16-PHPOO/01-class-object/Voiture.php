<?php 

// La Programmation Orientée Objet en PHP repose sur des concepts clés comme les classes, les objets et les instances. Elle inclut également des notions de visibilité qui contrôlent l'accès aux props et aux méthodes : 


// 1 - Déclaration d'une classe
// Une classe c'est un modèle qui définit les props (variables) et méthodes (fonctions) qui seront partagées par les objets créés à partir de cette classe 

class Voiture {

    public string $marque;
    public string $couleur;
    protected int $km;
    private string $moteur;

    public function demarrer() {
        return "La voiture démarre";
    }

    protected function ajouterKm() {
        return "J'ajoute des kms";
    }

    private function ouvertureCapot() {
        return "Le capot est ouvert :)";
    }
}

// 2 - Instanciation d'un objet 
// Pour utiliser ma classe, on doit créer un objet à partir de celle ci, c'est ce qu'on appelle l'instanciation 

// Instanciation de la classe voiture 
$voiture1 = new Voiture;

// Assignation de valeurs dans les propriétés
$voiture1->marque = "Toyota";
$voiture1->couleur = "Rouge";


// $voiture1->km = 12000; // Error, cannot acces protected property from global scope
// $voiture1->moteur = "Essence"; // Error, cannot access private property from global scope

// $voiture1->ajouterKm(); // Error, cannot acces protected ou private property from global scope

// Appel de ma éthode demarrer()
echo $voiture1->demarrer();

$voiture2 = new Voiture;
$voiture2->marque = "Peugeot";
$voiture2->couleur = "Bleu";

var_dump($voiture1);
var_dump($voiture2);

echo "Voiture 1 : " . $voiture1->demarrer();
echo "Voiture 2 : " . $voiture2->demarrer();

// Pour voir les méthodes d'un objet (le var_dump n'indiquant que les props)
// J'utilise get_class_methods 

var_dump(get_class_methods($voiture1));


// 3 - Visibilité : public, protected, private 
// La visibilité en PHP OO définit le niveau d'accès aux props et méthodes d'une classe 
// Public : Les props et méthodes public sont accessibles depuis n'importe où, scope global et local 
// Protected : Les props et méthodes protected sont accessibles uniquement depuis le scope local de la classe (error si appel depuis le global)
// Private : Les props et méthodes private sont accessibles uniquement depuis le scope local de la classe (error si appel depuis le global)

// Différence entre Protected et Private ? D'un point de vue accès à la donnée rien du tout, c'est identique, la différence intervient au niveau de l'héritage ! 
// Un élément protected sera bien transmis aux classes filles/héritières, alors qu'un élément private ne peut pas être transmit par héritage 