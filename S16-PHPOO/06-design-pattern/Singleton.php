<?php 


/*

Les design patterns (ou "patrons de conception") sont des solutions récurrentes à des problèmes courants de conception logicielle. Ce ne sont pas des morceaux de code tout faits, mais des structures ou modèles que l'on peut adapter à ses propres besoins dans le développement d'applications. Ils permettent d'améliorer la maintenabilité, la lisibilité et la réutilisabilité du code.

Voici un listing des Design Patterns organisés en trois groupes principaux : Créationnels, Structurels, et Comportementaux.

1. Patterns Créationnels

Ces patterns concernent la manière de créer des objets, en s’assurant que le processus de création est adapté à la situation.

    Singleton : Garantit qu'une classe n'a qu'une seule instance.
    Factory Method : Définit une interface pour créer des objets, mais laisse les sous-classes choisir la classe concrète à instancier.
    Abstract Factory : Fournit une interface pour créer des familles d'objets liés ou dépendants sans avoir à spécifier leurs classes concrètes.
    Builder : Sépare la construction d'un objet complexe de sa représentation pour que le même processus puisse créer différentes représentations.
    Prototype : Crée de nouveaux objets en clonant des instances existantes.

2. Patterns Structurels

Ces patterns se concentrent sur la composition d’objets et de classes pour former des structures plus grandes et efficaces.

    Adapter : Permet à des classes avec des interfaces incompatibles de fonctionner ensemble.
    Decorator : Attache dynamiquement des responsabilités supplémentaires à un objet.
    Proxy : Fournit un objet substitut ou représentant pour contrôler l'accès à un autre objet.
    Bridge : Sépare l'interface d'un objet de son implémentation pour qu'ils puissent varier indépendamment.
    Composite : Compose des objets en structures arborescentes pour représenter des hiérarchies.
    Facade : Fournit une interface simplifiée à un ensemble de sous-systèmes.
    Flyweight : Utilise le partage pour supporter efficacement de nombreux petits objets.

3. Patterns Comportementaux

Ces patterns se concentrent sur les interactions et la communication entre les objets.

    Observer : Définit une dépendance entre objets pour qu’un objet notifie automatiquement ses changements à d'autres.
    Strategy : Définit une famille d'algorithmes, encapsule chaque algorithme, et les rend interchangeables.
    Command : Encapsule une requête en tant qu’objet, permettant de paramétrer des clients avec des requêtes différentes.
    Iterator : Fournit un moyen d'accéder aux éléments d'une collection de manière séquentielle sans exposer sa représentation interne.
    Template Method : Définit la structure d'un algorithme, mais laisse certaines étapes aux sous-classes.
    State : Permet à un objet de changer de comportement lorsque son état change.
    Mediator : Définit un objet qui centralise la communication entre différentes classes.
    Memento : Capture et restaure l'état interne d'un objet sans violer son encapsulation.
    Chain of Responsibility : Permet de passer une requête à travers une chaîne de gestionnaires potentiels jusqu'à ce qu'elle soit traitée.
    Visitor : Permet de définir une nouvelle opération sans changer les classes des éléments sur lesquels elle opère.
    Interpreter : Définit une grammaire et un interprète pour les représentations de cette grammaire.

Ces groupes aident à mieux comprendre les différents objectifs et approches des design patterns, qu'il s'agisse de la manière dont les objets sont créés, structurés ou interagissent.

*/


/*

1. Singleton

Le Singleton garantit qu'une classe n'a qu'une seule instance dans toute l'application.

// Le Singleton, en programmation OO, répond à la problématique de n'avoir qu'une seule et unique instance d'une même classe dans un programme.
// Par exemple : en Web, la connexion au serveur de la BDD.
// Afin de préserver cette unicité, il est judicieux de suivre le pattern Singleton

// Un singleton est composé de 3 caractéristiques : 
    // - Une propriété privée et static qui conservera l'instance unique de la classe
    // - Un construct private pour empêcher la création d'objets depuis l'extérieur de la classe
    // - Une méthode static qui nous retourne l'instance unique de la classe et si elle n'a pas encore été créée, de la créer ! 


*/ 

class Singleton 
{

    // Prop static qui contiendra l'unique instance de cette classe
    private static ?Singleton $instance = null;

    // Le construct en private m'empêche de créer une instance depuis le scope global
    private function __construct() 
    {
        echo "<b>Le construct se lance ! Un nouvel objet est créé ! :) </b><hr>";
    }

    public static function getInstance()
    {
        if (self::$instance == null) { // Si $instance est vide, je crée l'unique objet ! 
            self::$instance = new self;
        } 
        return self::$instance; // Quoi qu'il en soit, je return la prop $instance qui contient forcément l'objet unique
    }
}

// $singleton = new Singleton;
// $singleton2 = new Singleton;
// $singleton3 = new Singleton;

$objet = Singleton::getInstance();
$objet2 = Singleton::getInstance();
$objet3 = Singleton::getInstance();
$objet4 = Singleton::getInstance();
$objet5 = Singleton::getInstance();
$objet6 = Singleton::getInstance();
$objet7 = Singleton::getInstance();

var_dump($objet);
var_dump($objet2);
var_dump($objet3);
var_dump($objet4);
var_dump($objet5);
var_dump($objet6);
var_dump($objet7);


