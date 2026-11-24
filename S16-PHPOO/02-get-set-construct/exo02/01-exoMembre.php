<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters (taille pseudo et format email) et gérer les cas d'erreurs d'une façon ou d'une autre 

   
************************** */



class Membre
{
    private string $pseudo;
    private string $email;

    public function __construct(string $newPseudo, string $newEmail)
    {
        echo "Instanciation, nous avons reçu les informations suivantes : $newPseudo et $newEmail<hr>";
        $this->setPseudo($newPseudo);
        $this->setEmail($newEmail);
    }

    public function setPseudo(string $newPseudo)
    {
        if (is_string($newPseudo)) {
            if (iconv_strlen($newPseudo) < 30 && iconv_strlen($newPseudo) > 0) {
                $this->pseudo = $newPseudo;
            } else trigger_error("Attention, le pseudo doit être un string de moins de 30 carac", E_USER_ERROR);
        } else trigger_error("Attention, le pseudo doit être un string de moins de 30 carac", E_USER_ERROR);
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setEmail(string $newEmail) 
    {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $this->email = $newEmail;
        } else trigger_error("Attention, le format d'email n'est pas correct", E_USER_ERROR);
    }

    public function getEmail()
    {
        return $this->email;
    }


}

$membre1 = new Membre('Pieral', "pierra@mail.com");
$membre1->setPseudo('Pieral');
$membre1->setEmail('lolo@oiu.fr');


echo 'Pseudo : ' . $membre1->getPseudo() . '<br>';
echo 'Email : ' . $membre1->getEmail() . '<br>';