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

        echo "<h2>02 - Variables : déclaration / affectation / type </h2>";
        // Une variable est un espace nommé permettant de conserver une valeur
        // Une variable se déclare avec le signe $ 
        // Caractères autorisés : a-z A-Z 0-9 _ 
        // Attention, on ne peut pas commencer par un chiffre
        // Attention, PHP est sensible à la casse (une minuscule n'est pas la même chose qu'une majuscule)

        $a = 123; // Déclaration de la variable nommée "a" et affectation de la valeur numérique 123 
        echo $a;
        echo gettype($a); // Integer = un entier 
        echo "<br>";

        $a = 1.5; // On change la valeur 
        echo $a;
        echo gettype($a); // double ou float = chiffre décimal
        echo "<br>";

        $a = "Une chaine";
        echo $a;
        echo gettype($a); // string = chaine de caractères

        $a = true;
        echo $a;
        echo gettype($a); // boolean = vrai ou faux   true/false  1/0 

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des chaines de caractères 
        // Le caractère de concaténation : le point "." MAIS il est aussi possible de concaténer avec la virgule "," 

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concat
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concat 
        echo $x . " " . $y . "<br>";
        echo $x, " ", $y, "<br>";
        // print $x , " " , $y , "<br>"; // Concaténation virgule = pas bon ménage avec le print ! Ne fonctionne pas...

        // Concaténation lors de l'affectation
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Ic j'écrase la valeur précédente 
        echo $prenom; // Ici j'ai Alexandre 

        // Pour rajouter sans écraser : 
        $prenom2 = "Pierre";
        $prenom2 = $prenom2 . "-Alexandre";

        // Raccourci d'écriture
        $prenom3 = "Pierre";
        $prenom3 .= "-Alexandre"; // Avec le .= on rajoute sans écraser 

        echo $prenom3;

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Dans des guillemets, une variable est reconnue et interprétée
        // Dans des apostrophes, une variable est comprise comme un simple string et donc non traitée 
        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // Une constante comme une variable permet de conserver une valeur 
        // Cependant, comme son nom l'indique cette valeur restera... constante ! Et elle ne pourra plus être modifiée dans la suite du code 
        // Par convention d'écriture, une constante s'écrit en majuscule 

        // On défini une constante avec la fonction define() 
        define("URL", "http://www.monsite.fr");
        echo URL;
        // URL = "qchoz";
        // define("URL", "qqchoz");
        // On ne peut pas redéfinir la constante 
        echo "<br>";
        // Constantes magiques 
        // Déjà inscrites au langage 
        // /!\ deux underscores avant et après 
        echo __FILE__ . "<br>";
        echo __LINE__ . "<br>";
        echo __DIR__ . "<br>";

        $a = "bleu";
        $b = "blanc";
        $c = "rouge";

        echo $a . " - " . $b . " - " . $c . "<br>";
        echo "$a - $b - $c <br>";

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition : 
        echo $a + $b . "<br>";
        // Soustraction 
        echo $a - $b . "<br>";
        // Multiplication
        echo $a * $b . "<br>";
        // Division
        echo $a / $b . "<br>";
        // Puissance
        echo $a ** $b . "<br>";
        // Modulo
        echo $a % $b . "<br>";

        // Opération / Affectation 
        $a += $b; // Equivaut à écrire $a = $a + $b;
        $a -= $b;
        $a *= $b;
        $a /= $b;
        $a **= $b;
        $a %= $b;

        echo "<h2>06 - Conditions & opérateurs de comparaison </h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) {
            echo "Vrai, la valeur de x est strictement supérieure à la valeur de y<br>";
        } else {
            echo "Faux<br>";
        }

        // Plusieurs conditions obligatoires : AND => && 
        if ($x > $y && $y > $z) {
            echo "Ok pour les deux conditions <br>";
        } else {
            echo "L'une ou l'autre ou les deux conditions sont fausses <br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR => || 
        if ($x > $y || $y < $z) {
            echo "Ok pour au moins une des conditions<br>";
        } else {
            echo "Toutes les conditions sont fausses<br>";
        }

        // xor 
        // Le xor n'accepte qu'une seule et unique bonne condition, s'il y en a deux, alors le xor échoue 
        if ($x > $y xor $y > $z) {
            echo "Ok pour une seule condition<br>";
        } else {
            echo "Toutes les conditions sont fausses ou il y a plus d'une bonne condition<br>";
        }

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x == 8) { // Si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // Si x est différent de 10
            echo "Réponse B<br>";
        } elseif ($y == $z) { // Si y est égal à z 
            echo "Réponse C<br>";
        } else { // Sinon...
            echo "Réponse D<br>";
        }
        // Réponse D ! 

        // Mais testons autre chose, avec x = 8 ....

        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) { // Si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // Si x est différent de 10
            echo "Réponse B<br>";
        } elseif ($y == $z) { // Si y est égal à z 
            echo "Réponse C<br>";
        } else { // Sinon...
            echo "Réponse D<br>";
        }

        // Comparaison stricte 
        $a1 = 1;
        $a2 = "1";

        // Comparaison des valeurs uniquement avec le == 
        if ($a1 == $a2) {
            echo "Ok ces deux variables ont la même valeur<br>";
        } else {
            echo "Non, ces deux variables n'ont pas la même valeur<br>";
        }

        // Comparaison des valeurs ET du type : Comparaison stricte 
        if ($a1 === $a2) {
            echo "Ok ces deux variables ont la même valeur et le même type<br>";
        } else {
            echo "Non, ces deux variables n'ont pas la même valeur et/ou pas le même type<br>";
        }

        /* 
            Opérateurs de comparaison 
            -----------------------------------
            =                       Affectation (ce n'est pas un opérateur de comparaison)
            ==                      Est égal à (uniquement les valeurs)
            !=                      Est différent de 
            ===                     Est strictement égal à (valeur et type)
            !==                     Est strictement différent de (valeur et/ou type différent)
            >                       Strictement supérieur à 
            >=                      Supérieur ou égal à 
            <                       Strictement inférieur 
            <=                      Inférieur ou égal 
        */

        // Autres possibilités de syntaxe pour les if 
        if ($a1 === $a2) {
            echo "Ok, ces deux variables ont la meme valeur et le même type<br>";
        }   // Si on ne veut pas gérer le else, on peut l'omettre 

        if ($a1 === $a2) echo "Ok, ces deux variables ont la meme valeur et le même type<br>";
        else echo "Non, ces deux variables n'ont pas la même valeur et/ou pas le même type<br>";

        if ($a1 === $a2) : ?>

            echo "Ok, ces deux variables ont la meme valeur et le même type<br>";

        <?php else : ?>
            "Ok, ces deux variables ont la meme valeur et le même type<br>";

            veniet ut rerum veritatis, doloribus error?
            Placeat, quos dicta natus iure vitae assumenda iusto beatae accusamus impedit at ut maiores illum dolor saepe, et cumque! Iste perspiciatis

        <?php
        endif;

        // Cette syntaxe avec des : au lieu des {} et on termine par le endif; 
        // Pratique dès lorsque dans les cas if/elseif/else nous avons de gros blocs HTML, on aura plutôt envie de fermer le PHP plutôt que de tout mettre dans un echo
        // Egalement la fermeture du if sera plus lisible avec un endif; plutôt qu'avec un  } 

        // Ecriture ternaire 
        // action (condition) ? .....if...... : .......else......
        echo ($a1 === $a2) ? "Ok les deux var ont meme valeur et meme type<br>" : "Non, ces deux var ont des valeurs et/ou types différents<br>";

        // En PHP avec les if on utilise régulièrement deux fonctions de contrôle : 
        // isset() & empty() 
        // isset() permet de savoir si une info/variable existe 
        // empty() permet de savoir si une information/variable existe MAIS AUSSI va vérifier si le contenu est vide ou pas  

        // isset()
        // La variable existe ? On obtient true 
        // La variable n'existe pas : On obtient false 

        // empty()
        // La variable n'existe pas : On obtient true 
        // La variable existe mais est vide : On obtient true 

        // La variable existe et contient quelque chose : on obtient false 

        $pseudo = "Bob";
        if (isset($pseudo)) {
            echo "La variable pseudo est bien définie<br>";
        } else {
            echo "La variable pseudo n'existe pas<br>";
        }

        $password = "";

        if (empty($password)) {
            echo "Attention, le password est vide!<br>";
        } else {
            echo "Tout va bien <br>";
        }

        $pseudoForm = "Frodon";

        $pseudo = $pseudoForm ?? "Pas de pseudo"; // Raccourci d'écriture pour un isset en ternaire, est ce que $pseudoForm existe ? Si oui $pseudo prends sa valeur, sinon il prends la valeur "Pas de pseudo"
        echo "<hr>";
        echo $pseudo;

        echo "<h2>Conditions switch</h2>";
        // Autre outil permettant de mettre en place des conditions 

        // Le switch ne s'utilise que dans un seul scénario, c'est lorsqu'on veut comparer un ensemble de possibilités pour une variable 

        $couleur = "jaune";

        switch ($couleur) {
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
                break;
            default: // équivalent au else 
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
                break; // break non obligatoire, c'est la fin de l'instruction de toute façon
        }

        // EXERCICE : refaire cette condition des couleurs switch mais en if / elseif / else 

        $couleur = "jaune";

        if ($couleur == "bleu") {
            echo "Vous aimez le bleu<br>";
        } elseif ($couleur == "rouge") {
            echo "Vous aimez le rouge<br>";
        } elseif ($couleur == "vert") {
            echo "Vous aimez le vert<br>";
        } else {
            echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
        }

        echo "<h2>08 - Fonctions prédéfinies</h2>";

        // Liste des fonctions/méthodes prédéfinies de PHP, il en existe des milliers :  https://www.php.net/manual/fr/indexes.functions.php 

        // Pour utiliser une fonction nous devons connaitre le nombre de param attendu par cette fonction et leur type et leur ordre
        // Et puis la valeur de retour/sortie de la fonction (est ce que ce sera un boolean ? un string ? ou autre chose ?)

        // Fonction date() 
        // Permet d'afficher la date du jour en choisissant le format attendu 

        // echo time(); // time() me retourne le timestamp actuel 
        // timestamp = le nombre de secondes écoulées depuis le 1er janvier 1970 minuit UTC Time, c'est ce qu'on considère être l'an zéro de l'informatique uniformisée 

        date_default_timezone_set("Europe/Paris");

        echo "Nous sommes le : " . date("d/m/Y") . " et il est : " . date("H:i:s") . "<hr>";

        // strlen() / iconv_strlen() 
        // Fonction prédéfinie permettant de compter le nombre de caractères dans une chaine3
        // echo strlen("bônjöùr") . "<br>";
        // echo strlen("東京日本語") . "<br>";
        // echo iconv_strlen("bônjöùr") . "<br>";
        echo iconv_strlen("東京日本語") . "<br>";

        // ATTENTION strlen() compte le nombre d'octets (en fonction des encodages, des accents etc, cela peut ne pas correspondre avec le nombre réel de caractères)
        // On préfèrera donc utiliser iconv_strlen pour compter véritablement le nombre de caractère

        // Beaucoup de fonctions is_qqchoz  permettant de vérifier les types de nos variables 
        if (is_integer($a1)) {
            echo "Oui c'est un integer";
        } else {
            echo "Non ce n'est pas un integer";
        }

        $prenom = "pierre";
        echo ucfirst($prenom);

        separateur();

        echo "<h2>08 - Fonctions utilisateurs</h2>";

        // Les fonctions utilisateurs = les fonctions développées par nos soins 

        // Fonction très simple permettant d'afficher 3 hr 
        function separateur(): void
        {
            echo "<hr><hr><hr>";
        }

        separateur();
        separateur();

        // Fonction avec des params 
        function dire_bonjour(string $qui): string
        {
            return "Bonjour $qui, bienvenue sur notre site<hr>";
        }

        echo dire_bonjour("Pierra");
        $prenom = "Jimmy";
        echo dire_bonjour($prenom);

        // Fonction pour calculer la TVA, le prix TTC
        function applique_tva(int $prix): string
        {
            return "Le montant TTC pour le prix $prix est de : " . ($prix * 1.2) . "€<hr>"; // Pour la tva à 20
        }

        echo applique_tva(500);

        // EXERCICE : refaire une fonction similaire MAIS permettant de choisir aussi le taux de TVA à appliquer
        // Attention, on veut saisir le taux sous forme d'entier ou de float (pour saisir 30 pour 30% de tva par exemple)

        // Une fois terminé, refaire la même fonction mais considérer que la saisie du taux est facultative, auquel cas, ce sera le taux de 20% par défaut

        function applique_tva_taux(int $prix, ?float $taux = 20): string
        {
            return "Le montant TTC pour le prix $prix avec le taux de $taux % est de : " . ($prix * (1 + $taux / 100)) . "€<hr>"; // Pour la tva à 20
        }

        echo applique_tva_taux(100, 5.5);
        echo applique_tva_taux(1000);

        // Fonction affichage meteo basique 
        function meteo(string $saison, float $temperature): string
        {
            $debut = "Nous sommes en " . $saison;
            $suite = " et il fait " . $temperature . " degré(s)<hr>";

            return $debut . $suite;
        }

        separateur();

        echo meteo("été", 35);
        echo meteo("printemps", 22);
        echo meteo("hiver", 1);
        echo meteo("automne", 15);

        // EXERCICE : Refaire la fonction en météo en gérant "au" printemps plutôt que "en" printemps ainsi que le s sur degré en fonction de la valeur de la température 








        ?>

    </div>


</body>

</html>