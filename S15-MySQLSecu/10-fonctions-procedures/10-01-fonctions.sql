--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------
--------------- FONCTIONS PREDEFINIES ------------------------------------------------------
--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------


-- Ici quelques exemples de fonctions prédéfinies 

USE bibliotheque;

SELECT DATABASE(); -- Fonction indiquant le nom de la bdd actuellement sélectionnée

SELECT LAST_INSERT_ID(); -- Le dernier id inséré dans la BDD (auto incrémenté) de la session actuelle
                            -- Les ORM récents dans les framework back utilisent cette fonction lorsque l'on fait une insertion dans une table mais que l'on continue de manipuler la donnée
                            -- Il sera toujours intéressant après une insertion de récupérer immédiatement l'id pour continuer à traiter l'élément justement au travers de son id 


-- Fonctions de manipulation de string
SELECT CONCAT("a","b","c"); -- Permet de concaténer pour mettre dans une seule colonne
SELECT CONCAT_WS(" - ", "a","b","c"); -- Concaténation avec un séparateur (toujours dans une seule colonne)

SELECT CONCAT_WS(" ", id_abonne, prenom) AS "liste" FROM abonne;

SELECT SUBSTRING("bonjour", 4); -- Permet de couper une chaine

SELECT REPLACE("www.coucou.com", "w", "W"); -- Remplace un string par un autre avec une chaine

SELECT UPPER("Salut"); -- Mets tout en maj 

-- Fonctions de manipulation de date 
SELECT CURDATE(); -- La date du jour
SELECT CURDATE() + 0; -- La date du jour

SELECT CURTIME(); -- L'heure de l'instant
SELECT NOW(); -- La date et l'heure
SELECT CURRENT_TIMESTAMP(); -- La date et l'heure

SELECT UNIX_TIMESTAMP(CURDATE()); -- Transforme une date en timestamp 

SELECT DATE_ADD(CURDATE(), INTERVAL 7 DAY); -- Pour ajouter un intervale de temps à une date (pourquoi pas une date limite d'emprunt sur la bibliotheque ?)
SELECT DATE_ADD(CURDATE(), INTERVAL 2 MONTH);
SELECT DATE_ADD(CURDATE(), INTERVAL 1 YEAR);

SELECT DAYNAME(CURDATE()); -- Le nom du jour

SELECT CURDATE();
SELECT DATE_FORMAT(CURDATE(), "%d-%m-%Y");
-- DATE_FORMAT nous permet de formater un type DATE/DATETIME en MySQL, cela nous permet de l'afficher en jour / mois / année plutot que annee - mois - jour 
-- Cela fonctionne avec des tokens de remplacement, voir doc !  https://sql.sh/fonctions/date_format


--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------
--------------- FONCTIONS UTILISATEURS -----------------------------------------------------
--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------

-- Fonctions que nous developpons nous même
-- Une fonction nous permet d'effectuer un traitement en particulier 
-- En MySQL une fonction nous retourne une valeur 

DELIMITER $ -- On doit changer le delimiter (le point virgule) car je vais avoir besoin de mettre des points virgules dans mes fonctions, donc pour éviter qu'il pense que je suis à la fin de l'instruction 

CREATE FUNCTION calcul_tva(nb INT) RETURNS TEXT -- On reçoit un param INT et on précise que le return sera du string 
COMMENT "Fonction permettant le calcul de la TVA" 
READS SQL DATA -- Indique simplement qu'on veut lire les données 
    BEGIN 
        RETURN CONCAT_WS(": ", "Le resultat est ", (nb*1.20));
    END $ 

DELIMITER ; 
SELECT calcul_tva(100);

-- Si on a besoin d'une variable dans une fonction on peut la déclarer avec DECLARE
-- Par exemple : DECLARE mavar INT  
    -- On peut insérer dans une variable le résultat d'une requête par exemple : SELECT xxxxx INTO mavar FROM xxxxxx WHERE xxxxxxx  

    -- Les FLAGS que l'on peut indiquer en début d'une fonction 
    -- NO SQL : Indique qu'une fonction ne contient pas d'instructions SQL 
    -- CONTAINS SQL : Indique que la fonction contient des instructions SQL qui n'effectuent ni lecture ni modification 
    -- READS SQL DATA : Indique que la fonction contient des instructions SELECT
    -- MODIFIES SQL DATA : Indique que la fonction contient des instructions INSERT, UPDATE ou DELETE 
    -- DETERMINISTIC: Spécifie qu'une fonction renvoie toujours le même résultat pour les mêmes paramètres d'entrée.
    -- NOT DETERMINISTIC: Spécifie qu'une fonction peut renvoyer des résultats différents à chaque exécution, même pour les mêmes paramètres d'entrée (par exemple, si elle utilise des fonctions aléatoires).
    -- SQL SECURITY : On peut définir le SQL SECURITY sur deux valeurs différentes (visible dans PHP My Admin) 
        -- DEFINER : Pour indiquer que ce sont les droits d'accès de la personne qui a défini la fonction qui vont s'appliquer lors de l'appel de cette fonction
        -- INVOKER : Pour indiquer sur ce sont les droits d'accès de la personne qui exécute la fonction qui vont s'appliquer 
            -- Utile si on a une fonction dont le comportement diffère en fonction des droits des utilisateurs 

  -- EXERCICE 1 : Le même calcul de TVA avec le choix du taux
  DELIMITER $

CREATE FUNCTION calcul_tva_param(montant_ht DECIMAL(10,2), taux_tva DECIMAL(5,2)) 
RETURNS VARCHAR(255)
COMMENT "Calcule la TVA et le TTC à partir d'un montant HT et d'un taux fourni (ex: 20)"
DETERMINISTIC
NO SQL 
BEGIN
    DECLARE montant_ttc DECIMAL(10,2);

        SET montant_ttc = montant_ht * (1 + (taux_tva / 100));

    RETURN CONCAT_WS(" | ", 
        CONCAT("HT: ", montant_ht, "€"), 
        CONCAT("Taux: ", taux_tva, "%"), 
        CONCAT("TTC: ", montant_ttc, "€")
    );
END $

DELIMITER ;

-- Exemples d'appels :
SELECT calcul_tva_param(65789, 34.33);

-------------------------------------------------------------
   CREATE FUNCTiON calcul_TVAtaux(nb INT, taux FLOAT) RETURNS TEXT -- On reçoit un argument INT et on précise que la fonction renverra du texte
    COMMENT "Fonction permettant le calcul de la TVA"
    READS SQL DATA
        BEGIN 
            RETURN CONCAT_WS(": ", "le resultat est", ROUND((nb*(1+(taux/100))), 2));
        END $
    DELIMITER ; 
    SELECT calcul_TVAtaux(100,50);


  -- EXERCICE 2 : Faire une fonction qui me retourne le nombre d'employés pour un service envoyé en param de la fonction 

  USE entreprise;

DELIMITER $

CREATE FUNCTION nombre_employes_service(nom_service VARCHAR(30)) RETURNS INT
COMMENT "Fonction permettant de compter le nombre d'employes dans un service"
READS SQL DATA
BEGIN
    DECLARE total INT;

    SELECT COUNT(*) INTO total
    FROM employes
    WHERE service = nom_service;

    RETURN total;
END $

DELIMITER ;

SELECT nombre_employes_service("commercial");
SELECT nombre_employes_service("informatique");

