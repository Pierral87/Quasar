------------------------------------------------------------------------------
------------------------------------------------------------------------------
--------- LES EVENEMENTS -----------------------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Les évènements permettent de programmer des actions sur une base de temps, c'est à dire à un moment précis ou tout de suite, et avec une répétition ou pas

-- Par exemple : 
    -- Des requêtes de nettoyage de bdd
    -- Des requêtes de sauvegarde/backup/copie de bdd
    -- Différer des traitements 
    -- Programmer des requêtes de nuit 
    -- Etc. 

-- Pour vérifier si les évènements sont activés sur votre serveur de BDD on vérifie la variable globale "event_scheduler"
SHOW GLOBAL VARIABLES LIKE "event_scheduler";
+-----------------+-------+
| Variable_name   | Value |
+-----------------+-------+
| event_scheduler | ON    |
+-----------------+-------+

-- Si jamais elle était sur OFF il faut l'activer avec la ligne suivante : 
SET GLOBAL event_scheduler = 1;

-- Pour voir les events rattachés à une base 
SHOW EVENTS;
SHOW EVENTS \G;

-- Création d'un évènement qui ajoute un employé dans la table employes à chaque minute 
CREATE EVENT e_enregistrement_employes 
    ON SCHEDULE EVERY 1 MINUTE 
DO INSERT INTO employes (prenom) VALUES ("Pierral");
-- Ici le mot clé EVERY indique que l'évènement est récurrent ! Il est suivi par l'intervalle entre chaque répétition, c'est à dire ici, chaque minute on insère Pierral 

-- Ci après un évènement ONE TIME, c'est à dire une seule insertion/action 
    -- On va aussi le faire démarer à un moment précis 
    CREATE EVENT e_insert_after_two_minute 
    ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 2 MINUTE 
    DO INSERT INTO employes (prenom) VALUES ("Sam");
    -- grâce au mot clé AT on peut spécifier une date précise ou bien un intervale de temps après le CURRENT_TIMESTAMP 

-- Si on voulait mettre une date précise on ferait 
-- ON SCHEDULE AT "2026-01-20 10:30:00"

-- Un event récurrent qui s'execute à une certaine date 
CREATE EVENT e_insert_one_minute_start_after
ON SCHEDULE EVERY 1 MINUTE STARTS "2026-01-19 13:25:00"
DO INSERT INTO employes (prenom) VALUES ("Aragorn");
-- Là je défini qu'il démarre à une date précise, puis se lance chaque minute

-- On peut aussi donner une date de fin à un évènement 
CREATE EVENT e_insert_end 
ON SCHEDULE EVERY 5 SECOND 
ENDS CURRENT_TIMESTAMP + INTERVAL 1 MINUTE  -- Ici je définie une date de fin, donc, dans une minute ! 
DO INSERT INTO employes (prenom) VALUES ("Gimli");


-----------------------------------------------------------

-- On va mettre en place un évènement de type "back up de table"
-- Le but ici étant de copier l'intégralité d'une table pour l'insérer dans une autre 
-- Dans la base entreprise on va créer une table "journal" 
-- On va ensuite insérer du contenu dans cette table et lancer un evenement qui copie la table dans une autre 


CREATE TABLE IF NOT EXISTS journal (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO journal (id_journal, titre, texte) VALUES
(1, 'sortie iphone 5', 'voici le telephone : iphone 5');


-- Ci dessous une table identique pour recevoir la copie de la première
CREATE TABLE IF NOT EXISTS journal_copie (
  id_journal int(10) NOT NULL AUTO_INCREMENT,
  titre varchar(20) NOT NULL,
  texte text NOT NULL,
  PRIMARY KEY (id_journal)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Maintenant mon event qui me permet de copier le contenu d'une table à l'autre 


-- Ici je supprime tout le contenu de la table journal copie avant d'y réinsérer la totalité du contenu de la table journal 
DELIMITER $ 
CREATE EVENT e_journal_backup 
    ON SCHEDULE EVERY 1 MINUTE 
        DO 
            BEGIN 
                DELETE FROM journal_copie;
                INSERT INTO journal_copie SELECT * FROM journal;
            END 
    $

DELIMITER ; 




DELIMITER $ 
-- On pourrait également faire en sorte de créer des tables datées qui serviraient de back up à des dates spécifiques
-- Ci dessous une procédure que l'on pourrait exécuter via un event (chaque nuit par exemple, ou chaque semaine ou autre)

CREATE procedure save_employes() 
BEGIN 
-- Ci dessous une requête préparée (sécurité), qui nous permet de créer une table copie_employes_dateDuLancementDuNow 
    SET @sql = CONCAT("CREATE TABLE copie_employes_", NOW()+0, " SELECT * FROM employes");
    PREPARE req FROM @sql;
    EXECUTE req;
END $

DELIMITER ; 

CALL save_employes();



------------------------------------------------
USE bibliotheque; 
-- Exercice 1 : 
    -- Créer un event qui inscrit dans une nouvelle table "emprunts_en_retard" les abonnés qui ont des emprunts dont la date_rendu est NULL et dont la date_sortie dépasse 30 jours 
    	CREATE TABLE emprunts_en_retard (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_abonne INT NOT NULL,
            id_livre INT NOT NULL,
            date_sortie DATE NOT NULL
            ) ENGINE=InnoDB;

        DELIMITER $ 

        CREATE EVENT e_emprunts_en_retard
        ON SCHEDULE EVERY 1 DAY 
        DO 
            BEGIN 
                DELETE FROM emprunts_en_retard;
                INSERT INTO emprunts_en_retard (id_abonne, id_livre, date_sortie) SELECT id_abonne, id_livre, date_sortie 
                FROM emprunt 
                WHERE date_rendu IS NULL 
                AND DATEDIFF(CURDATE(), date_sortie) > 30;
            END $ 

        DELIMITER ; 
-- Exercice 2 : 
    -- Archivage des emprunts terminés : Créer une table historique_emprunts pour stocker les emprunts dont la date_rendu est renseignée 
        -- Après avoir fait cet event, refaite le en supprimant l'emprunt terminé de la table emprunt classique, on considèrera que notre table emprunt actuelle est une table emprunt "en cours"
        CREATE TABLE historique_emprunts (
            id_emprunt INT NOT NULL,
            id_livre INT NOT NULL,
            id_abonne INT NOT NULL,
            date_sortie DATE NOT NULL,
            date_rendu DATE NOT NULL,
            PRIMARY KEY (id_emprunt)
            ) ENGINE=InnoDB;

            DELIMITER $ 
            CREATE EVENT e_historique_emprunts 
                ON SCHEDULE EVERY 1 DAY 
                DO 
                    BEGIN 
                        INSERT INTO historique_emprunts SELECT * FROM emprunt WHERE date_rendu IS NOT NULL;
                        DELETE FROM emprunt WHERE date_rendu IS NOT NULL; 
                    END $ 

            DELIMITER ; 
-- Exercice 3 : 
    -- Comptage des emprunts mensuels 
        -- Créer une table stats_emprunts pour stocker les statistiques mensuelles (mois, année, nombre d'emprunts) 
            -- Créer un évènement qui s'exécute chaque début de mois pour calculer le nombre d'emprunts effectués le mois précédent 
        CREATE TABLE stats_emprunts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mois INT NOT NULL,
            annee INT NOT NULL,
            total_emprunts INT NOT NULL
            ) ENGINE=InnoDB;


        -- ------------------------------------------------------- Ci dessous pour le mois précédent 
            DELIMITER $ 
            CREATE EVENT e_stats_emprunts 
                ON SCHEDULE EVERY 1 MONTH
                DO 
                    BEGIN 
                        INSERT INTO stats_emprunts (mois, annee, total_emprunts) SELECT MONTH(date_sortie), YEAR(date_sortie), COUNT(*) 
                        FROM historique_emprunts 
                        WHERE date_sortie BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW();
                    END $ 
            DELIMITER ; 

            -- -------------------------------------------------------------


-- Si on voulait récupérer les mois encore d'avant, on pourrait faire comme ceci, par contre attention ça recalculerait la totalité des emprunts de chaque mois à chaque fois 
            CREATE EVENT calculer_stats_mensuelles
                    ON SCHEDULE EVERY 1 MONTH 
                     DO
                    BEGIN 
                        INSERT INTO stats_emprunts (mois, annee, total_emprunts)
                            SELECT MONTH(date_sortie), YEAR(date_sortie), COUNT(*)
                            FROM emprunt
                                WHERE date_sortie BETWEEN DATE_SUB(CURDATE(), INTERVAL 12 YEAR) AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                    GROUP BY MONTH(date_sortie), YEAR(date_sortie);
                    END $

-- Exercice 4 : 
    -- Notification d'emprunts par auteur 
        -- Créer un évènement qui s'exécute tous les jours pour insérer dans une table "statistiques_auteurs" les statistiques des emprunts par autour pour les livres empruntés la veille 
        CREATE TABLE statistiques_auteurs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            auteur VARCHAR(25),
            total_emprunts INT,
            date_stat DATE
            ) ENGINE=InnoDB;

            DELIMITER $ 

            CREATE EVENT e_statistiques_auteurs 
                ON SCHEDULE EVERY 1 DAY  
                    DO 
                        BEGIN 
                            DECLARE hier DATE ;
                            SET hier = CURDATE() - INTERVAL 1 DAY; 
                            INSERT INTO statistiques_auteurs (auteur, total_emprunts, date_stat) SELECT l.auteur, COUNT(*) AS total_emprunts, hier AS date_stat 
                            FROM livre l  
                            JOIN emprunt e ON e.id_livre = l.id_livre 
                            WHERE e.date_sortie = hier 
                            GROUP BY l.auteur; 
                        END $ 


            DELIMITER ; 