<?php 


/* 
EXERCICE :
-----------
- Création d'un espace de dialogue / de tchat

- 01 - Création de la BDD : dialogue
     -  Table : commentaire
     - Champs de la table commentaire :
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME
        
- 02 - Créer une connexion à cette base avec PDO
- 03 - Création d'un formulaire html permettant de poster un message
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation
- 04 - Récupération des saisies du form avec controle 
- 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
- 06 - Requete de récupération des messages afin de les afficher dans cette page
- 07 - Affichage des messages avec un peu mise en forme
- 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
- 09 - Affichage de la date en français
- 10 - Amélioration du css

*/
?>