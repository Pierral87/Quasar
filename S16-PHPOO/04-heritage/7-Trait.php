<?php 

/* 

--- Traits : 
    Les traits permettent de regrouper des methodes et des props réutilisables dans des classes sans utiliser l'héritage (étant lui même limité à un seul héritage par classe)

    Les traits sont utiles pour éviter la duplication de code entre des classes qui ne partagent pas forcément un même héritage

    Egalement, on peut appeler plusieurs traits à la fois ! (tout comme les interfaces), ce qui fait sauter la limite de l'héritage 

    Lorsqu'on récupère un trait, on récupère les éléments de toutes les visibilités ! Même les éléments private ! 

*/

trait Identifiable 
{
    public string $id;

    public function afficherId() 
    {
        echo "L'id de cet élément est : $this->id";
    }
}

trait UnTrait 
{
    public string $trait = "Un Trait";
}

class Userr 
{
    use Identifiable, UnTrait;
}

$user = new Userr; 

var_dump($user);
var_dump(get_class_methods($user));