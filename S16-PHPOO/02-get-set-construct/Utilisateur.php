<?php 

/* 
    02 - Getter, Setter, Construct, This

Dans la programmation orientée objet (POO) en PHP, les concepts de getter, setter, constructeur (__construct), et $this sont des mécanismes essentiels qui permettent d’organiser et de structurer les classes, tout en contrôlant la manipulation des propriétés des objets.

--- Le Constructeur (__construct)
Le constructeur est une méthode spéciale (il fait partie des méthodes magiques de la PHP OO) dans une classe qui est automatiquement appelée lors de la création d'un objet à partir de cette classe. Il permet souvent d'initialiser les propriétés de l'objet dès sa création.

--- Le mot-clé $this 
En PHP, le mot-clé $this fait référence à l'objet courant dans lequel il est utilisé. Il permet d'accéder aux propriétés et méthodes de cet objet depuis l'intérieur de la classe.

--- Les Getters 
Un getter est une méthode publique qui permet d'accéder aux propriétés d'une classe, tout en gardant les propriétés elles-mêmes protected ou private. Cela permet de mieux contrôler et sécuriser l'accès aux données. On l'utilise souvent en combinaison avec des casting de type ou de la formalisation de la data (uc_first par exemple, trim ou autre)

--- Les Setters
Un setter est une méthode publique qui permet de modifier la valeur d'une propriété private ou protected. Comme pour les getters, cela permet de valider et contrôler les changements sur les propriétés. On peut s'en servir pour appliquer déjà des contrôles de validation de data sur les insertions dans les props, également pour générer des logs d'accès à ces datas. Les setters nous permettent de toujours garder le même point d'entrée pour l'accès à une data spécifique.

    Il y aura toujours une paire getter/setter pour chaque propriété de l'objet
     // Un setter sans vérification est toujours utile ! Il faut penser à l'avenir de notre application 
        // Il est toujours bon de normaliser les appels des props de nos objets (c'est à dire, toujours en faisant un appel d'une prop d'un objet en appelant une méthode getProp()) pour s'assurer que ce n'est pas différent d'un objet à l'autre 
        // Idem pour les setters et leurs vérifications, si je n'ai pas de vérification à faire pour le moment, c'est pas grave, je sais que je normalise l'appel d'un changement de prop par ces méthodes setProp()
        // Si un jour je veux rajouter un contrôle sur une prop, j'ai simplement à modifier le code dans la méthode set associée et rien d'autre dans le reste de mon code 
        // Si je défini un setter avec une validation, je m'assure que la propriété en question reçoit uniquement des valeurs valides.

*/

class Utilisateur 
{
    protected string $nom;
    protected string $email;

        // Constructeur pour initialiser les propriétés
    public function __construct(string $nom, string $email) 
    // Ici le __construct se lance dès que j'instancie un objet (son scénario de lancement est déjà défini par PHP), il récupère les params fournis à l'instanciation (qui sont maintenant des params obligatoires à fournir à l'instanciation) et me permet de les répercuter dans les props de l'objet
    {
         // Il est déjà bon d'appeler nos setter à l'intérieur du constructeur, ce qui nous permet déjà de filtrer les données 
        $this->setNom($nom);
        $this->setEmail($email);
        echo "L'OBJET EST EN TRAIN D'ETRE INSTANCIE !!! JE SUIS DANS LE CONSTRUCT !!!<hr>";
    }

    public function saluer()
    {
        return "Bonjour, je m'appelle " . $this->nom;
    }

    public function getNom(){
        // $this représente l'objet courant c'est à dire l'objet en cours d'utilisation
        // Il nous permet de représenter dès la définition de notre classe, les objets futurement créés et manipulés
        return $this->nom;
    }

    public function setNom(string $newNom){
        if(iconv_strlen($newNom) >= 1) {
             $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas faire moins d'un caractère", E_USER_NOTICE);
        }
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(string $newEmail){
        $this->email = $newEmail;
    }
}


// $utilisateur->nom = "Pierra";
// $utilisateur->email = "pierra@mail.com";


// Instanciation de notre objet maintenant avec le constructeur, les params nom et email sont obligatoire à fournir ! 
$utilisateur = new Utilisateur("Pierra", "pierra@mail.com");

// Cela m'évite de les saisir un par un comme ci dessous
// $utilisateur->setNom("Pierra");
// $utilisateur->setEmail("pierra@mail.com");

echo $utilisateur->saluer();