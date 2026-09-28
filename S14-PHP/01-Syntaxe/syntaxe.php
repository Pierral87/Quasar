<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrainement PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Syntaxe PHP</h2>

        <!-- Il est possible d'écrire du HTML dans un fichier.php 
            En revanche, l'inverse n'est pas possible !   
        -->

        <?php 
        // Ouverture de la balise PHP 

        // Ceci est un commentaire sur une ligne 
        # Ceci est un copmmentaire sur une ligne  
        /* 
            Commentaire 
            Entre les deux indicateurs 
        */

            // La doc Officielle : 
                // https://www.php.net/

            // Les bonnes pratiques et conventions d'écriture : 
            // https://phptherightway.com 
            // https://eilgin.github.io/php-the-right-way/


        echo "<h2>01 - Instruction d'affichage</h2>";
        // echo est une instruction du langage permettant de générer un affichage 

        // ATTENTION EN PHP CHAQUE INSTRUCTION SE TERMINE PAR UN ;  

        echo "Bonjour";

        print "Nous sommes lundi<br>"; // Autre instruction permettant de générer un affichage
        // On utilisera toujours echo, c'est le standard ! 
        // D'ailleurs, print n'acceptera pas certaines concaténations 

        

        ?>

    </div>


</body>

</html>