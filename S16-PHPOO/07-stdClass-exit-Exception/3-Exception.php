<?php

/* 

    Les Exception en PHP 

    Les exceptions en PHP permettent de gérer les erreurs et les conditions anormales de manière contrôlée.
    Contrairement aux fatal error qui arrêtent totalement le script, ainsi que les fonctions die/exit, les exceptions offrent un moyen d'intercepter les erreurs et de les traiter proprement
    On pourra également décider de poursuivre ou pas l'exécution du code 

    Pour ça, on utilisera toujours les exceptions via des blocs try/catch 

    Structure de base de la manipulation d'une exception : 

    try : Bloc où l'on place le code qui peut potentiellement générer une exception 
    throw : Lancement d'une exception 
    catch : Intercepte une exception qui vient d'être "throw" et permet de la traiter (nombreuses informations accessibles à l'intérieur de l'objet Exception)
    finally : Est un bloc que l'on peut rajouter après le try/catch qui s'exécutera quoi qu'il en soit, que l'on soit passé dans le catch ou pas 

*/

// On va faire une fonction banale qui contient un lancement d'exception 

function diviser($a, $b)
{
    // Cette fonction va faire une division
    // Je connais un cas d'erreur, celui d'une division par zero qui est impossible ! 

    if ($b == 0) {
        // Je tombe dans mon cas d'erreur, je vais décider ici de lancer une erreur de type "Exception"
        // Exception fait parti de la famille des throwable (lançable)
        // C'est une instanciation spécifique avec throw qui permet de faire sortir l'objet de son scope local et de se faire attraper dans un catch 
        throw new Exception("Division par zéro interdite!");
    }

    return $a / $b;
}

echo diviser(10, 5); // Ici division ok 
echo "<hr>";
// echo diviser(10, 0); // Ici cas d'erreur division par 0
// Si je suis dans le global scope alors c'est une fatal error le code s'arrête 

// Le but pour nous ici est de géré cette erreur au travers du bloc try catch et grâce au lancement de l'exception
// Tout dépends du niveau de l'erreur, ici, nous décidons de faire poursuivre le code ! Sinon on pourrait directement décider de lancer un exit ou un die  


// Dans un boc try je peux tenter le code que je souhaite, si tout va bien, on poursuit sans problèmes et on sort du bloc try
// Si jamais un problème est rencontré (fatal error), on va tomber dans le bloc catch 

try {
    echo "<h2>Coucou, je suis dans le bloc try ! </h2>";
    echo diviser(10, 5); // Tout va bien 
    echo diviser(10, 2); // Tout va bien

    echo diviser(10, 0); // Ca va mal ! Lancement de l'exception ! Je vais atterrir dans le bloc catch ! 
    echo "Je suis après l'erreur du lancement de l'exception";
} catch (Exception $e) {
    // SI j'arrive ici c'est qu'une exception a été throw par une instruction dans le try ! 
    // Dans ce cas, je peux ici exécuter le code de mon choix et manipuler l'objet Exception si je le souhaite
    // Dans cet objet je retrouverai de nombreuses informations utiles en rapport avec l'erreur
    echo "<h2>Oulala ! Je suis tombé dans le catch =( </h2>";

    // var_dump($e);
    // var_dump(get_class_methods($e));
    echo "Erreur : " . $e->getMessage() . " - déclenchée par : " . $e->getTraceAsString() . "<hr>";
} finally { // Le bloc finally s'exécute quoi qu'il en soit 
    echo "<h2>Je suis le finally ! Je m'exécute quoi qu'il arrive ! </h2>";
}

//  Grace à la bonne gestion de l'exception au travers des blocs try/catch, il m'est possible de poursuivre le code ! Contrairement à un fatal error et une exception non caught qui stoppe directement l'execution du code 
echo "<hr>Après le try catch";
