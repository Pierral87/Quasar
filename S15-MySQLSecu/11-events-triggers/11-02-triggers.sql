------------------------------------------------------------------------------
------------------------------------------------------------------------------
--------- LES TRIGGERS -------------------------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Un Trigger/Declencheur, c'est un peu comme une fonction ou une procédure mais je ne peux pas l'exécuter directement
-- Par contre je peux préciser l'action qui va déclencher ces instructions 

-- On déclenche généralement des triggers après des requêtes spécifiques, ce qui nous permet de déclencher certaines actions automatiquement

-- Tout comme les events, on les utilise pour automatiser certaines taches, non pas sur une base de temps mais à la suite de certaines actions 

SHOW TRIGGERS; -- Montre les triggers de la base en cours
SHOW TRIGGERS \G;
DROP TRIGGER nom_du_trigger; -- Supprime un trigger 

USE entreprise; 

-- Création d'une table employes_informations dans la base entreprise 
-- Cette table va contenir plusieurs champs : 
    -- un id 
    -- un champ nombre représentant le nombre d'employés de l'entreprise 
    -- un champ dernière date d'embauche qui représente la dernière date du dernier employé embauché 

    CREATE TABLE IF NOT EXISTS employes_informations (
            id_employes_informations int NOT NULL AUTO_INCREMENT,
            nombre int NOT NULL,
            derniere_date_embauche date NOT NULL,
            PRIMARY KEY (id_employes_informations)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

    -- On insère (à la main) dans cette table les informations à jour, afin d'avoir une valeur saine enregistrée avant de mettre en place notre trigger 

    -- Le but du trigger ici va être de continuer à mettre à jour les informations de cette table, sans que nous n'ayons besoin de le faire à la main 

DELIMITER $

    CREATE TRIGGER t_maj_info_employes AFTER INSERT ON employes   -- ici indique qu'il se déclenche après un insert sur la table employes 
    FOR EACH ROW    -- Pour chaque ligne 
    BEGIN  
        UPDATE employes_informations SET nombre = nombre + 1, derniere_date_embauche = NEW.date_embauche;
    END $

DELIMITER ; 

-- Ce trigger permet au système de comprendre qu'après une insertion sur la table employés, on doit lancer un UPDATE sur employes_informations, c'est une action qui se declenchera automatiquement ! Elle va incrémenter "nombre" et modifier "derniere_date_embauche"

-- AFTER INSERT ON indique que le trigger se lancer APRES une insertion (cela pourrait être BEFORE pour avant), cela fonctionne pour toutes les requêtes action, AFTER UPDATE, AFTER DELETE etc  
-- For EACH ROW pour dire qu'il se lance à chaque fois 
-- la notion des valeurs NEW et OLD 
    -- NEW permet d'accèder à la valeur entrante (une valeur venant d'une insertion ou la nouvelle valeur d'une modification)
    -- OLD permet d'accèder à la valeur sortante (la valeur qui sera remplacée ou supprimée dans la table (delete ou update))

--# Exercice 1/ création de la table de "employes_sauvegarde" : Exactement la méme table que la table employes avec les mémes champs mais vide !
CREATE TABLE IF NOT EXISTS employes_sauvegarde (
  id_employes int(4) NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--# exercice : Faite en sorte d'inscrire des données dans "employes_sauvegarde" pour toute nouvelle insertion dans la table employes (en plus de la maj sur la table employes_informations) 

DELIMITER $ 

CREATE TRIGGER t_maj_save_employes AFTER INSERT ON employes 
FOR EACH ROW 
BEGIN 
    UPDATE employes_informations SET nombre = nombre + 1, derniere_date_embauche = NEW.date_embauche; 
    INSERT INTO employes_sauvegarde (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (NEW.id_employes, NEW.prenom, NEW.nom, NEW.sexe, NEW.service, NEW.date_embauche, NEW.salaire);
END $ 

DELIMITER ; 

--# Exercice 2/ Création d'une table "employes_supprime" : Exactement la méme table que la table employes avec les mémes champs mais vide !
CREATE TABLE IF NOT EXISTS employes_supprime (
  id_employes int(4) NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--# exercice : Faite en sorte d'enregistrer tous les employes supprimés. Cela nous servira de corbeille 

DELIMITER $ 

CREATE TRIGGER t_supprimer_employes AFTER DELETE ON employes 
FOR EACH ROW 
BEGIN 
    INSERT INTO employes_supprime (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (OLD.id_employes, OLD.prenom, OLD.nom, OLD.sexe, OLD.service, OLD.date_embauche, OLD.salaire);
END $ 

DELIMITER ; 

--# Exercice 3/ Création de la table "employes_salaire" 
CREATE TABLE IF NOT EXISTS employes_salaire (
  id_employes_salaire int(11) NOT NULL AUTO_INCREMENT,
  id_employes int(11) NOT NULL,
  champ varchar(15) NOT NULL DEFAULT 'salaire',
  ancien int(11) NOT NULL,
  nouveau int(11) NOT NULL,
  difference int(11) NOT NULL,
  date_modification datetime NOT NULL,
  PRIMARY KEY (id_employes_salaire)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
--# exercice : Dés que le salaire d'un employes est CHANGé (et uniquement dans ce cas), nous voulons conserver l'historique des changement de salaire dans une table "employes_salaire"

DELIMITER $ 

CREATE TRIGGER t_employes_salaire AFTER UPDATE ON employes 
FOR EACH ROW 
BEGIN 
 IF NEW.salaire <> OLD.salaire THEN INSERT INTO employes_salaire (id_employes, ancien, nouveau, difference, date_modification) VALUES (NEW.id_employes, OLD.salaire, NEW.salaire, 
 CASE 
    WHEN NEW.salaire > OLD.salaire THEN NEW.salaire - OLD.salaire 
    WHEN OLD.salaire > NEW.salaire THEN OLD.salaire - NEW.salaire END, 
 NOW()); 
 END IF;
END $ 

DELIMITER ; 


DELIMITER $ 

CREATE TRIGGER t_employes_salaire AFTER UPDATE ON employes 
FOR EACH ROW 
BEGIN 
 IF NEW.salaire <> OLD.salaire THEN INSERT INTO employes_salaire (id_employes, ancien, nouveau, difference, date_modification) VALUES (NEW.id_employes, OLD.salaire, NEW.salaire, 
 NEW.salaire - OLD.salaire , 
 NOW()); 
 END IF;
END $ 

DELIMITER ; 

--# Exercice 4/ Création dune table "employes_action" :
CREATE TABLE IF NOT EXISTS employes_action (
  id_action int(11) NOT NULL AUTO_INCREMENT,
  id_employes int(11) NOT NULL,
  requete enum('update','delete','insert') NOT NULL,
  date_action datetime NOT NULL,
  PRIMARY KEY (id_action)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--# Le but de l'exercice est de repertorier les actions passées sur la table employes (INSERT, UPDATE, DELETE)

DELIMITER $ 

CREATE TRIGGER t_action_insert AFTER INSERT ON employes 
FOR EACH ROW 
BEGIN 
    INSERT INTO employes_action (id_employes, requete, date_action) VALUES (NEW.id_employes, "insert", NOW());
END $ 

CREATE TRIGGER t_action_update AFTER UPDATE ON employes 
FOR EACH ROW 
BEGIN 
    INSERT INTO employes_action (id_employes, requete, date_action) VALUES (NEW.id_employes, "update", NOW());
END $ 

CREATE TRIGGER t_action_delete AFTER DELETE ON employes 
FOR EACH ROW 
BEGIN 
    INSERT INTO employes_action (id_employes, requete, date_action) VALUES (OLD.id_employes, "delete", NOW());
END $ 