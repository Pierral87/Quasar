<?php 

/*

Exercice 1 : Héritage et surcharge

Objectif : Créer une classe de base CompteUtilisateur qui gère les informations générales d'un utilisateur. Ensuite, créer une classe dérivée ComptePremium qui hérite de CompteUtilisateur et qui ajoute des fonctionnalités spécifiques aux comptes premium.

Énoncé :

    Créer une classe CompteUtilisateur avec les propriétés protégées $nom et $email, ainsi qu'une méthode afficherInfos() qui affiche les informations de l'utilisateur.
    Créer une classe ComptePremium qui hérite de CompteUtilisateur et surcharge la méthode afficherInfos() pour ajouter "Compte Premium" dans les informations affichées.
    Instancier les deux types d’utilisateurs et appelle leurs méthodes afficherInfos().

*/