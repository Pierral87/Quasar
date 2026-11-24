<?php 

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/


class CompteBancaire
{
    // Propriétés avec différentes visibilités
    private string $titulaire;
    private float $solde;

    // Constructeur pour initialiser les valeurs
    public function __construct(string $titulaire, float $soldeInitial)
    {
        $this->setTitulaire($titulaire);
        $this->setSolde($soldeInitial);
    }

    // Getter pour obtenir le titulaire
    public function getTitulaire()
    {
        return $this->titulaire;
    }

    // Setter pour modifier le titulaire
    public function setTitulaire(string $newTitulaire)
    {
        $this->titulaire = $newTitulaire;
    }

    // Getter pour obtenir le solde
    public function getSolde()
    {
        return $this->solde;
    }

    // Setter pour modifier le solde
    public function setSolde(string $newSolde)
    {
        $this->solde = $newSolde;
    }

    // Méthode pour déposer de l'argent
    public function deposer(int $montant)
    {
        $soldeEnCours = $this->getSolde();

        if ($montant > 0) {
             $this->setSolde($soldeEnCours + $montant);
        return "Vous avez déposé $montant" . "€ votre solde est maintenant à : " . $this->getSolde() . "€<br>";
        } else {
            trigger_error("Erreur de montant", E_USER_ERROR);
        }
       
    }

    // Méthode pour retirer de l'argent
    public function retirer(int $montant)
    {
        if ($montant > 0) {
        $this->setSolde($this->getSolde() - $montant);
        $extra = ($this->getSolde() < 0) ? "Attention vous êtes maintenant à découvert !<br>" : "";
        return "Vous avez retiré $montant" . "€ votre solde est maintenant à : " . $this->getSolde() . "€<br>$extra";
         } else {
            trigger_error("Erreur de montant", E_USER_ERROR);
        }
    }

    public function afficherSolde()
    {
        if ($this->getSolde() > 0) {
            return "Le solde est : " . $this->getSolde() . "€<br>";
        } else return "Attention, vous êtes à découvert ! <br> Le solde est : " . $this->getSolde() . "€<br>";
    }
}

// Création d'une instance de CompteBancaire
$monCompte = new CompteBancaire("Pierra", 500);
echo $monCompte->afficherSolde();
echo $monCompte->deposer(250);
echo $monCompte->afficherSolde();
echo $monCompte->retirer(650);
echo $monCompte->afficherSolde();
echo $monCompte->retirer(650);
echo $monCompte->afficherSolde();