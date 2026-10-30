--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------
--------------- PROCEDURE STOCKEE ----------------------------------------------------------
--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------

-- Une procédure est très similaire à une fonction
-- En MySQL la différence réside dans le fait qu'une fonction retourne une simple valeur alors que la procédure retourne un jeu de résultat de requête 

-- Les avantages d'une procédure stockée 
    -- Moins de risque de se tromper : plus facile de lancer une procédure nommée par exemple selectAll(), plutôt qu'à chaque fois de réécrire une requête SELECT avec une grosse jointure
    -- Meilleure compréhension : plus facile de lire le nom de la procédure plutôt qu'une requête entière 
    -- Facilité d'utilisation : Si d'autres personnes manipulent la BDD, même sans connaissances avancées en SQL, ils pourront comprendre facilement l'exécution d'une procédure 
    -- Evolutivité : Si la requête est amenée à changer, elle ne sera modifiée qu'à un seul endroit, dans le SGBD et pas besoin de modifier tous les endroits du back qui l'appelle 
    -- Sécurité : On laisse le travail à une seule personne : "La personne qui gère la BDD"
    -- Optimisation : La procédure se lance plus rapidement qu'une requête à la main car l'analyse et l'interprétation de la requête sont déjà effectuées 


DELIMITER $  

----------------------------------
-- Création d'une procédure stockée qui affiche la date du jour en français 
CREATE PROCEDURE date_du_jour()
BEGIN 
    SELECT DATE_FORMAT(CURDATE(), "%d/%m/%Y") AS "today";
END $ 
CALL date_du_jour() $


-- On peut avoir des params entrant/sortant d'une procédure 
    -- IN : entrant 
    -- OUT : sortant 
    -- INOUT : les deux 

    CREATE PROCEDURE addition(IN valeur1 INT, IN valeur2 INT)
    BEGIN 
        SELECT valeur1+valeur2;
    END$ 

    CALL addition(17,3) $

-- - Exercice 1/ Faire une procédure stockée qui affiche toutes les informations de tous les employes

DELIMITER $

CREATE PROCEDURE selectAllEmployes()
BEGIN 
    SELECT * FROM employes;
END$


CALL selectAllEmployes() $

-- - Exercice 2/ Faire une PROCEDURE qui prends en param le prenom d'un employe et qui affiche le service et le salaire de l'employé

CREATE PROCEDURE get_employe_info(IN employe_prenom VARCHAR(50))
BEGIN
    SELECT prenom, service, salaire 
    FROM employes 
    WHERE prenom = employe_prenom;
END $

CALL get_employe_info('Daniel')$

-- - Exercice 3/ Cette année, chaque salarié va toucher 10% de son salaire en plus et une prime de 700€. Faite une procédure permettant de calculer le nouveau salaire annuel de chaque salarié et de le modifier. Le but étant d'appeler la procédure pour un salarié à la fois
DELIMITER $

CREATE PROCEDURE augmenter_salaire(IN prenom_employe VARCHAR(40))
BEGIN
    UPDATE employes
    SET salaire = (salaire * 1.10) + 700
    WHERE prenom = prenom_employe;
END $

CALL augmenter_salaire("Jean-Pierre");

-- - Exercice 4/ Faire une procédure qui prends en param le prénom et indique de quel groupe il fait parti parmis les groupes suivant 
                        -- Plus de 3000e = Groupe 1 
                        -- Entre 2000 et 3000 = Groupe 2 
                        -- Entre 0 et 2000 = Groupe 3 

CREATE PROCEDURE groupe_employe(IN prenom_emp VARCHAR(25))
BEGIN 
    DECLARE salaire_emp INT;
    SELECT salaire FROM employes WHERE prenom=prenom_emp INTO salaire_emp;

    IF salaire_emp > 3000 THEN 
    SELECT CONCAT("L'utilisateur fait partie du Groupe 1");
    ELSEIF salaire_emp >= 2000 AND salaire_emp <= 3000 THEN 
    SELECT CONCAT("L'utilisateur fait partie du Groupe 2");
    ELSEIF salaire_emp >= 0 AND salaire_emp < 2000 THEN 
    SELECT CONCAT("L'utilisateur fait partie du Groupe 3");
    ELSE 
    SELECT CONCAT("Employé inconnu");
    END IF;

END $

CALL groupe_employe("Jean-Pierre")$
CALL groupe_employe("Stephanie")$
CALL groupe_employe("Julien")$
