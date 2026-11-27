<?php

namespace ProjetAdmin\Controller;

use ProjetAdmin\Model\UserRepository;

class UserController
{

    protected UserRepository $model;  // Cette prop va contenir un objet de type Model, c'est notre classe qui va piocher en BDD

    public function __construct()
    {
        echo "<h2>Initialisation du UserController !!! Je suis dans son construct </h2>";
        $this->model = new UserRepository;
    }

    // La méthode render va me permettre de gérer l'affichage de mes vues
    // Au travers de la mémoire tampon (l'output buffer)
    public function render($layout, $vue, $parameters = array())
    {
        // extract permet d'extraire chaque indice d'un array et le transforme en variable
        // par exemple parameters["title"] devient  $title 
        extract($parameters);

        ob_start(); // On démarre ici une mise en tampon, en gros, on place un point de sauvegarde et on stoppe le renvoie des informations vers le user, cela va nous permettre de "modeliser" la page avant l'envoie 

        require_once "src/View/$vue"; // Cette inclusion est stockée dans la variable $content
        $content = ob_get_clean(); // ob_get_clean permet de récupérer tout ce qui a été chargé et de le décharger dans une variable (ici c'est notre vue ListUser.php)

        ob_start();
        require_once "src/View/$layout"; // Envoi du gabari de base du layout (header, nav, footer etc)

        return ob_end_flush(); // Va libérer tout l'affichage et fait apparaitre sur le navigateur.
    }


    // Ici la méthode handleRequest permet de comprendre la demande de l'utilisateur
    public function handleRequest()
    {
        // op sera soit rien soit add select update delete par exemple
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
        } else {
            $op = null;
        }

        // En fonction des demandes, on aura aussi un id dans l'url (select un user sur son id)
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = null;
        }

        try {
            if ($op == "add") {
                // Si le user demande un ajout
                $this->add();
            } elseif ($op == "select") {
                // Si le user demande un select d'un user
                $this->select($id);
            } elseif ($op == "delete") {
                // Si le user demande une suppression
                $this->delete($id);
            } elseif ($op == "update") {
                // Si le user demande une modification
                $this->update($id);
            } else {
                // Sinon cas par defaut, on affiche la totalité des users
                $this->selectAll();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    // Ci dessous la méthode me permettant de gérer la demande d'affichage de tous les users 
    public function selectAll(){
        // J'appelle mon model pour lui demander de me retourner tous les utilisateurs de ma base 
        $users = $this->model->modelSelectAll();
        // var_dump($users);
        // require("src/View/templateListUser.php");
        $this->render("layout.php", "ListUser.php", [
            "title" => "Liste des employés Autre titre",
            "data" => $users
        ]);
    }

    public function select($id) {
        $user = $this->model->modelSelectOne($id);
        // var_dump($user);
        $this->render("layout.php", "OneUser.php", [
            "title" => "Information du user $id",
            "data" => $user
        ]);
    }
}
