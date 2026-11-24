<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
            - Le réservoir d'un véhicule contient maximum 50 litres
            - La méthode donnerEssence() ne permet pas de choisir le nombre de litres que l'utilisateur met, si c'est possible on lui met directement le plein entier, si ce n'est pas possible ....... à voir :) 
            - Gérez les exceptions qui peuvent être rencontrées à l'appel de la méthode donnerEssence()


 */

class Vehicule
{
    private int $litresReservoir;

    public function setlitresReservoir(int $newReservoir)
    {
        if ($newReservoir >= 0 && $newReservoir <= 50) {
            $this->litresReservoir = $newReservoir;
        } else {
            trigger_error("La voiture contient entre 0 et 50 litres exactement, pas de changement de litres !", E_USER_NOTICE);
        }
    }

    public function getlitresReservoir()
    {
        return $this->litresReservoir;
    }
}


class Pompe
{
    private int $litresStock;

    public function setlitresStock(int $newStock)
    {
        if ($newStock >= 0) {
            $this->litresStock = $newStock;
        } else {
            trigger_error("Probleme de montant", E_USER_NOTICE);
        }
    }

    public function getlitresStock()
    {
        return $this->litresStock;
    }

    public function donnerEssence(Vehicule $vhc)
    {
        // var_dump($vhc);
        // Ici je me rends compte que j'ai bien accès à l'objet vehicule !
        // De fait de l'avoir mis en param obligatoire, alors j'accède à chacun des objets Vehicule que l'on me transmet 

        $litresReservoirVhc = $vhc->getlitresReservoir(); // Ce qu'il reste dans le vhc
        $litresStock = $this->getlitresStock(); // Ce qu'il reste dans la pompe
        $litresManquant = 50 - $litresReservoirVhc;

        // Plusieurs scnéarios pour donnerEssence() 
            // 1 - La pompe est vide ! On ne peut rien faire, la pompe reste à 0, les litres du vhc restes inchangés 
            // 2 - Le véhicule a déjà le plein ! Rien à faire :) 
            // 3 - La pompe a assez pour faire le plein ! Le vhc passe à 50 et on soustrait à la pompe les litres manquant du vhc (les litres qu'on va mettre dans le vhc)
            // 4 - La pompe a des litres, mais pas assez pour faire le plein... On va donner au vhc ce qu'on peut. La pompe passe à 0 et le vhc récupère quelques litres 

            if($litresStock == 0) { // 1 - Pompe vide  
            echo "<h3>Désolé la pompe est vide </h3><hr>";
            } elseif ($litresManquant == 0) { // 2 - la voiture a déjà le plein
            echo "<h3>Vous avez déjà le plein lol ! </h3><hr>";
            } elseif ($litresStock >= $litresManquant) { // 3 - On a assez pour faire le plein ! 
            $vhc->setlitresReservoir(50); // La voiture a le plein ! 
            $this->setlitresStock($litresStock - $litresManquant); // On soustrait les litres qu'on rajoute dans la voiture, à la pompe
            echo "<h3>Vous avez maintenant le plein ! Vous avez remplit $litresManquant litres</h3><hr>";
            } else { // 4 - On a des litres mais pas assez pour faire le plein, on donne tout ! 
            $vhc->setlitresReservoir($litresStock + $litresReservoirVhc); // On rajoute à la voiture, les litres présents dans la pompe 
            $this->setlitresStock(0); // La pompe passe à 0 
            echo "<h3>Pas assez pour faire le plein, on vous a mis tout ce qu'on avait, à savoir $litresStock litres</h3><hr>";
            }
                
    }
}

$vehicule1 = new Vehicule;
$vehicule1->setlitresReservoir(40);

$vehicule2 = new Vehicule;
$vehicule2->setlitresReservoir(10);

$vehicule3 = new Vehicule;
$vehicule3->setlitresReservoir(20);

$vehicule4 = new Vehicule;
$vehicule4->setlitresReservoir(50);

$pompe1 = new Pompe;
$pompe1->setlitresStock(40);

$pompe1->donnerEssence($vehicule1);
$pompe1->donnerEssence($vehicule4);
$pompe1->donnerEssence($vehicule2);

$pompe1->donnerEssence($vehicule3);




