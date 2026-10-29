<?php

// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------
// ---------- PDO : PHP DATA OBJECT ---------------------------------------------
// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------

// PDO est une classe prédéfinie de PHP, elle représente une connexion à un serveur de BDD
// On va le manipuler avec MySQL mais on peut le manipuler avec d'autres SGBD 
// En quelques sortes, on peut considérer que PDO est une "porte" vers notre BDD 

echo "<h2>01 - Connexion à la BDD</h2>";
// Pour créer une connexion à la BDD nous avons plusieurs de plusieurs info (voir doc)
// - le host et le nom de la bdd 
// - le login 
// - le password
// - eventuellement des options 

$host = "mysql:host=localhost;dbname=entreprise_quasar"; // Hote et nom de bdd 
$login = "root";
$password = ""; // sur MAMP attention, le password c'est root
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Gestion des erreurs par EXCEPTION
);

// Création de l'objet PDO : 
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    die;
}


// Si le var_dump nous indique bien un objet PDO alors tout a bien fonctionné, je suis maintenant connecté à ma base enreprise_quasar! elle est acccesible sur $pdo 
var_dump($pdo);


echo "<h2>02 - Requêtes de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD 

// On va utiliser ici la méthode "query" qui lance les requêtes directement (un peu comme dans la console)
// !!!!! ATTENTION !!!!! cette méthode est sensible aux injections SQL !!! Dans un vrai contexte, on fera toujours des requêtes préparées avec la méthode prepare() 


$stmt = $pdo->query("INSERT INTO employes (prenom, nom, salaire, sexe, date_embauche, service) VALUES ('Pierral', 'Lacaze', 12000, 'm', CURDATE(), 'Formation')");

// var_dump($stmt);

// $stmt est un objet de type PDOStatement (en gros, un objet "Réponse d'une requête sur PDO"), c'est un sous object de PDO qui représente la réponse dans la requête 
// Pour une requête de type action nous n'avons pas vraiment de réponse mais on a accès à plusieurs méthodes nous donnant quelques informations intéressantes 

// Par exemple, rowCount() nous donne le nombre de lignes impactées par la requête.

// echo "Nombre de lignes impactées par la requête : " . $stmt->rowCount() . "<br>";


echo "<h2>03 - Requêtes de sélection pour une seule ligne de résultat</h2>";

// Selectionnons les informations de l'employé 996
$stmt = $pdo->query("SELECT * FROM employes WHERE id_employes = 996");
// Ci dessous, le résultat dans la console 
// +-------------+---------+--------+------+-----------+---------------+---------+
// | id_employes | prenom  | nom    | sexe | service   | date_embauche | salaire |
// +-------------+---------+--------+------+-----------+---------------+---------+
// |         996 | Pierral | Lacaze | m    | Formation | 2026-10-28    |   12000 |
// +-------------+---------+--------+------+-----------+---------------+---------+

var_dump($stmt);

// Actuellement je ne peux pas exploiter la réponse de la BDD, je n'ai accès à aucune information dans PDOStatement sauf une prop qui m'indiquel a requête qui a été lancée
// Pour la rendre exploitable, il faut extraire le résultat grâce à la méthode fetch()
// Par défaut fetch() va me renvoyer un array ! 

// fetch() a plusieurs modes de fonctionnement qui vont déterminer le type de array transmit 

// FETCH_ASSOC : Pour récupérer un array associatif ! (nom des colonnes du résultat bdd deviendront les keys du array php)
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// array (size=7)
//   'id_employes' => int 996
//   'prenom' => string 'Pierral' (length=7)
//   'nom' => string 'Lacaze' (length=6)
//   'sexe' => string 'm' (length=1)
//   'service' => string 'Formation' (length=9)
//   'date_embauche' => string '2026-10-28' (length=10)
//   'salaire' => float 12000

// echo "Le prénom de l'employé sélectionné dans la BDD : " . $data["prenom"] . "<br>";

// FETCH_NUM : Pour récupérer un array indexé numériquement
// $data = $stmt->fetch(PDO::FETCH_NUM);
// var_dump($data);
// array (size=7)
//   0 => int 996
//   1 => string 'Pierral' (length=7)
//   2 => string 'Lacaze' (length=6)
//   3 => string 'm' (length=1)
//   4 => string 'Formation' (length=9)
//   5 => string '2026-10-28' (length=10)
//   6 => float 12000


// FETCH_BOTH : Pour récupérer un array indexé A LA FOIS numériquement et associativement
// $data = $stmt->fetch(PDO::FETCH_BOTH);
// var_dump($data);

// FETCH_OBJ : Pour récupérer non pas un array mais un objet ! Il aura des propriétés au même nom que les colonnes du résultat SQL
$data = $stmt->fetch(PDO::FETCH_OBJ);
var_dump($data);


echo "Le prénom de l'employé sélectionné dans la BDD : " . $data->prenom . "<br>";


echo "<h2>04 - Requêtes de selection pour plusieurs lignes de résultats</h2>";

$stmt = $pdo->query("SELECT * FROM employes");
echo "Nombre d'employés : " . $stmt->rowCount() . "<hr>";
// fetch() ne rtaite qu'une seule ligne à la fois ! 
// A chaque fois que je l'appelle, il traite une ligne puis encore une autre et une autre et une autre, une par une ! 
// Pour traiter un résultat à plusieurs lignes en utilisant fetch()  je peux faire une boucle ! 
// L'utilisation de la boucle while est judicieuse car elle tourne tant qu'il y a des résultats dans le stmt 
// fetch() va me renvoyer false dès lors qu'il n'y a plus de résultats dans le stmt, donc la boucle s'arrêtera 
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);

// while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($data);
//     echo "<hr>";
// }

// Je peux interpréter le résultat comme je veux pour faire de l'affichage 

// On va faire ici des petits divs bleu en CSS 

echo '<div style="display:flex; flex-wrap: wrap; justify-content: space-between">';
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <div style="margin-top: 20px; padding: 1%; width: 20%; background-color: steelblue; color: white">
        ID : <?= $ligne['id_employes'] ?><br>
        Prénom :<?= $ligne['prenom'] ?><br>
        Nom :<?= $ligne['nom'] ?><br>
        Service :<?= $ligne['service'] ?><br>
        Salaire :<?= $ligne['salaire'] ?><br>
        Sexe :<?= $ligne['sexe'] ?><br>
        Date embauche :<?= $ligne['date_embauche'] ?><br>
    </div>
<?php endwhile;
echo '</div><br><br>';



// Ici avec un tableau html à structure fixe 

$stmt = $pdo->query("SELECT * FROM employes");
echo '<style>th, td { padding: 10px; } </style>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
echo '<th>Id employes </th>';
echo '<th>Prénom </th>';
echo '<th>Nom </th>';
echo '<th>Sexe </th>';
echo '<th>Service </th>';
echo '<th>Date embauche </th>';
echo '<th>Salaire </th>';
echo '</tr>';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

echo '<hr><hr><hr>';


// Ici on va mettre en place un code qui permettra de s'adapter à n'importe quelle requête et va gérer la structure du tableau automatiquement 

$stmt = $pdo->query("SELECT prenom, nom, service, salaire FROM employes");

// Il existe une méthode dans PDOStatement columnCount() 
// Elle me permet de comprendre le nombre de colonne dans la réponse 
// Il existe aussi une méthode getColumnMeta() qui prends en param un int qui correspond à une colonne (0 correspondra à la première colonne du résultat)
// getColumnMeta me donne des infos sur la colonne sélectionnée 

// echo "Nombre de colonnes dans le résultat : " . $stmt->columnCount();
// var_dump($stmt->getColumnMeta(4));

echo '<table border="1" style="border-collapse : collapse; width:100%;">';
echo '<tr>';
for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $infoColonne = $stmt->getColumnMeta($i);
    echo "<th>" . ucfirst($infoColonne["name"]) . "</th>";
}
echo "</tr>";

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
echo '<hr><hr><hr>';


echo "<h2>05 - Requêtes de sélection pour plusieurs lignes de résultat avec fetchAll()</h2>";
// fetch() permet de traiter une seule ligne à la fois ! 
// fetchAll() traite toutes les lignes en une seule fois sauf que  : 

$stmt = $pdo->query("SELECT * FROM employes");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($data);

echo "Premier employé de la BDD : " . $data[0]["prenom"] . "<hr>";


//  EXERCICE : Affichez les noms et prénoms des employés dans une liste ul li 
// Le faire avec fetch 
$stmt = $pdo->query("SELECT nom, prenom FROM employes");
echo "<ul>";
while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<li>" . $data["nom"] . " " . $data["prenom"] . "</li>";
}
echo "</ul><hr><hr>";

// Le faire aussi avec fetchAll
$stmt = $pdo->query("SELECT nom, prenom FROM employes");
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<ul>";
foreach($employes AS $employe) {
    echo "<li>" . $employe["nom"] . " " . $employe["prenom"] . "</li>";

}
echo "</ul><hr><hr>";



echo "<h2>06 - Requêtes préparées pour se protéger des injections SQL !</h2>";

// prepare() permet de sécuriser les requêtes pour éviter les injections SQL 
// Si dans la requête on attend une information de l'utilisateur (par exemple saisie form ou clic GET) alors il n'est pas impossible de recevoir une attaque à ce niveau là
// C'est à dire, l'utilisateur peut saisir du code SQL dans le form et il sera interprété dans notre code 
// Le prepare() nous permet de filtrer toutes les saisies et les comprendre comme du pur string 

$nom = '"); DROP DATABASE entreprise_quasar;"'; // Information récupérée d'un form, on cherche un user sur son nom de famille 

// Première étape prépration de la requête 

// Première syntaxe avec les ? 
// Les ? symbolisent des "trous" dans la requête
// $stmt = $pdo->query("SELECT * FROM employes WHERE nom = '$nom'");
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = ?");
$stmt->execute([$nom]); // On fourni dans un array param du execute, les valeurs à transmettre dans l'ordre dans les "?"
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data); 


$nom = 'laborde'; // Information récupérée d'un form, on cherche un user sur son nom de famille 

// Deuxième syntaxe avec les tokens 
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // On nomme les valeurs attendus par un mot précédé de ":"
$stmt->bindParam(":nom", $nom, PDO::PARAM_STR); // On bind une valeur au token et on indique le filtre de notre choix, ici en string 
// Si j'ai plusieurs param à binder, j'ai besoin d'une ligne de bindparam pour CHAQUE token 
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);

