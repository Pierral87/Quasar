<?php
namespace App;
/*

    Les Namespaces en PHP : 

Les namespaces en PHP c'est un moyen d'organiser et de structurer les classes, interfaces, fonctions et autres de manière logique pour éviter essentiellement les conflits de nom.
Ils sont particulièrement utiles dans les projets complexes ou lorsque l'on appelle des bibliothèques externes.

En gros, les namespaces vont éviter les collisions de noms en séparant avec des espaces de noms/namespace  (comme des dossiers virtuels) 

*/


// Classe que j'ai faites moi même 
// namespace MyLibrary;
// class Utilisateur 
// {
//     public function getNom()
//     {
//         return "Frodon";
//     }
// }

// J'importe une librairie sur mon projet...
// Elle aussi n'a pas de namespace et contient également une classe... Utilisateur 
// Pas de chance... Doublons de nom, conflit ! 
// namespace LibraryA;
// class Utilisateur 
// {
//     public function getName()
//     {
//         return "Gimli";
//     }
// }

// Bien que l'on puisse définir plusieurs namespace dans un fichier, ce n'est pas une bonne pratique ! 
// On se rappelle de l'organisation de nos fichiers en PHP OO, une classe = un fichier donc on aura un seul namespace par fichier 
// Pas de soucis pour que des classes puissent partager le même namespace
// Ce qu'on fait à terme, c'est qu'on défini aussi un dossier portant le même nom que le namespace 
// On peut aussi avoir plusieurs namespaces, avec des noms composés par exemple App\MyClasses\Controller 

// En PHP OO pour pouvoir utiliser une classe venant d'un autre fichier, on utilise les instructions include/require 

use LibraryA\Utilisateurs;
use MyLibrary\Utilisateurs as Users;

require("MyUtilisateur.php");
require("LibraryUtilisateur.php");

// J'ai ces deux classes Utilisateur sur mon fichier grâce aux require, je peux maintenant les utiliser sans conflit 

// Comment instancier mes deux classes avec des names spaces ?

// Plusieurs choix : 
// 1 - Avec le FQN 
// Fully Qualified Name, c'est le nom entier de l'élément incluant son namespace
// Il nous suffit de faire un new puis d'écrire la totalité des namespaces séparés par antislash et le nom de classe à la fin.

$myUser = new \MyLibrary\Utilisateurs; // Ici j'ai besoin de l'antislash pour sortir de mon namespace perso
$libraryUser = new \LibraryA\Utilisateurs;

var_dump($myUser);
var_dump($libraryUser);

// 2 - Avec l'importation au travers de use 
// Dans mon IDE? lorsque je saisi uniquement un nom de classe, il me proposera toutes les classes qu'il connait avec ce nom, également celles qui viennent de namespace spécifique
// Si je choisis par exemple à l'autocompletion l'utilisateur venant de LibraryA, automatiquement l'IDE va rajouter une intruction "use" en haut de mon fichier et il indiquera : 
// user LibraryA\Utilisateurs 
// Ce qui se traduit par  : "Lorsqu'on parle de Utilisateurs tout court, on parle de LibraryA\Utilisateurs  
$userLibA = new Utilisateurs;
// Egalement, si on a deux classe du même nom, l'IDE adapte le use et donne un alias à la classe, on pourra évidemment le modifier après dans l'instruction use 
$userMy = new Users;

var_dump($userMy);

// Grâce à mon IDE, le système d'utilisation de mes classes à namespace devient beaucoup plus simple et j'ai moins besoin de réfléchir contrairement à l'utilisation des FQN ! 

// Il existe une constante magique qui nous permet de savoir dans quel namespace on se trouve __NAMESPACE__ 
// Par défaut cela ne renvoie rien quand on est dans le namespace global
echo __NAMESPACE__;

// Si je me trouve dans un Namespace, je suis à un niveau différent du scope global normal de PHP ! 
// C'est à dire que toutes les classes natives de PHP ne sont pas présente dans ce namespace
// Pour retrouver le scope global de PHP et ses classes, il faudra "remonter d'un niveau" en indiquant un antislash devant l'appel de nos classe 

// Par exemple PDO sans l'antislash il le cherche dans le namespace App
// Avec l'antislash on sort du scope du namespace et on revient dans le global
// $pdo = new \PDO("base");