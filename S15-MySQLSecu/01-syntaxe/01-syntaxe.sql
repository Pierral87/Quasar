-----------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------
----------------------------------------------------- SYNTAXE MYSQL ---------------------------------------
-----------------------------------------------------------------------------------------------------------


-- Ceci est un commentaire sur une ligne 
# Ceci est un commentaire aussi sur une ligne 
/* 
Commentaire entre les deux indicateurs
*/

-- Pour se connecter à la console MySQL : 

    -- Wamp : Ouvrir le menu MySQL et Console MySQL (login : root, password :    pas de password)
    -- Mamp : /Applications/MAMP/Library/bin/mysql -u root -p  (sur MAMP, login : root, password : root)

-- Lien utile, la documentation SQL : https://sql.sh

-- Les requêtes ne sont pas sensibles à la casse, en revanche, une convention d'écriture nous demande d'écrire les mots clés en majuscule 
-- SELECT prenom FROM abonnes;

-- Chaque instruction doit se terminer par un ;  

-- Pour créer une BASE 
CREATE DATABASE ma_bdd; -- Permet de creer une bdd

SHOW DATABASES; -- Pour voir la liste des BDD sur le serveur
SHOW TABLES; -- Pour voir la liste des tables d'une BDD
SHOW WARNINGS; -- Pour voir plus de détails sur la derniere erreur rencontrée

USE ma_bdd; -- Pour se positionner sur une BDD pour travailler dessus 
SELECT DATABASE(); -- Pour vérifier quelle est la base actuellement sélectionnée

DROP DATABASE ma_bdd; -- Pour supprimer une BDD
DROP TABLE nom_de_table; -- Pour supprimer une table 

TRUNCATE nom_de_table; -- Pour vider une table (attention c'est une requete structure)
DELETE FROM nom_de_table; -- Pour vider une table (là c'est une requete classique action)

DESC nom_de_table; -- Pour avoir la DESCription de la structure de la table 

CREATE DATABASE entreprise_quasar;
USE entreprise_quasar;

-- Création d'une table employes dans la base entreprise
CREATE TABLE IF NOT EXISTS employes (
  id_employes int NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- Insertions dans la table employes 
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);


--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
------------ REQUETES DE SELECTION (On questionne la BDD) ----------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------

-- Affichage complet des données d'une table 
SELECT * FROM employes;

-- Affichage complet des données de la table (dans l'ordre souhaité)
SELECT id_employes, nom, prenom, sexe, salaire, service, date_embauche FROM employes;

-- Selection de simplement quelques champs de la table 
SELECT nom, prenom FROM employes;

-- Exercice : Affichez la liste des différents services de la table employes 
SELECT service FROM employes; -- Si je me contente de ça, alors j'ai 20 services ! le service de chaque employé
-- Si je veux vraiment la liste des DIFFERENTES services j'utilise DISTINCT
SELECT DISTINCT service FROM employes;
+---------------+
| service       |
+---------------+
| direction     |
| commercial    |
| production    |
| secretariat   |
| comptabilite  |
| informatique  |
| communication |
| juridique     |
| assistant     |
+---------------+

-- CONDITION WHERE 
-- Affichage des employés du service informatique 
SELECT * FROM employes WHERE service = "informatique";
SELECT * FROM employes WHERE service = 'informatique';
+-------------+---------+--------+------+--------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service      | date_embauche | salaire |
+-------------+---------+--------+------+--------------+---------------+---------+
|         701 | Mathieu | Vignal | m    | informatique | 2013-04-03    |    2500 |
|         802 | Damien  | Durand | m    | informatique | 2014-07-05    |    2250 |
|         854 | Daniel  | Chevel | m    | informatique | 2015-09-28    |    3100 |
+-------------+---------+--------+------+--------------+---------------+---------+

-- BETWEEN 
-- Affichage des employés ayant été embauchés entre 2015 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND "2026-10-26";
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND CURDATE();
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND NOW();
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND CURRENT_TIMESTAMP();
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         854 | Daniel    | Chevel  | m    | informatique | 2015-09-28    |    3100 |
|         876 | Nathalie  | Martin  | f    | juridique    | 2016-01-12    |    3550 |
|         900 | Benoit    | Lagarde | m    | production   | 2016-06-03    |    2550 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
|         990 | Stephanie | Lafaye  | f    | assistant    | 2017-03-01    |    1775 |
+-------------+-----------+---------+------+--------------+---------------+---------+

-- LIKE la valeur approchante 
-- Like nous permet de rechercher une information qui n'est saisie qui partiellement 
-- Affichage des prénoms commençant par la lettre "s"
SELECT prenom FROM employes WHERE prenom LIKE "s%";
-- % signifie peu importe ce qui se trouve là
+-----------+
| prenom    |
+-----------+
| Stephanie |
+-----------+

-- Affichage des préonms finissant par les lettres "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie";
+-----------+
| prenom    |
+-----------+
| Elodie    |
| Melanie   |
| Nathalie  |
| Emilie    |
| Stephanie |
+-----------+

-- Affichage des préonms contenant les lettres "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie%";

-- EXCLUSION
-- Tous les employés sauf ceux d'un service particulier, par exemple sauf le service commercial 
SELECT * FROM employes WHERE service != "commercial";

-- Les opérateurs de comparaison :
--  =   est égal à
--  !=  est différent de
--  > strictement supérieur
--  >= supérieur ou égal
--  <  strictement inférieur
--  <= inférieur ou égal

-- Les employes ayant un salaire supérieur à 3000 
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
+----------+-------------+--------------+---------+
| nom      | prenom      | service      | salaire |
+----------+-------------+--------------+---------+
| Laborde  | Jean-pierre | direction    |    5000 |
| Winter   | Thomas      | commercial   |    3550 |
| Collier  | Melanie     | commercial   |    3100 |
| Blanchet | Laura       | direction    |    4500 |
| Chevel   | Daniel      | informatique |    3100 |
| Martin   | Nathalie    | juridique    |    3550 |
+----------+-------------+--------------+---------+

-- ORDER BY pour ordonner les résultats 
-- Affichage des employés dans l'ordre alphabétique 
SELECT * FROM employes ORDER BY nom;
SELECT * FROM employes ORDER BY nom ASC; -- ASC pour ascendant (par défaut si non précisé)

-- Ordre inversé : DESC pour descendant 
SELECT * FROM employes ORDER BY nom DESC;

-- Il est possible d'ordonner sur plusieurs champs. 
SELECT service, nom, prenom FROM employes ORDER BY service, nom;


-- LIMIT pour limiter le nombre de résultats (exemple pour une pagination)
-- Affichage des employés 3 par 3 
SELECT * FROM employes LIMIT 0, 3;  -- LIMIT position_de_depart, nb_de_lignes
+-------------+-------------+---------+------+------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service    | date_embauche | salaire |
+-------------+-------------+---------+------+------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction  | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial | 2011-05-03    |    3550 |
+-------------+-------------+---------+------+------------+---------------+---------+

-- Les trois suivants...
SELECT * FROM employes LIMIT 3, 3;
+-------------+---------+---------+------+--------------+---------------+---------+
| id_employes | prenom  | nom     | sexe | service      | date_embauche | salaire |
+-------------+---------+---------+------+--------------+---------------+---------+
|         417 | Chloe   | Dubar   | f    | production   | 2011-09-05    |    1900 |
|         491 | Elodie  | Fellier | f    | secretariat  | 2011-11-22    |    1600 |
|         509 | Fabrice | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
+-------------+---------+---------+------+--------------+---------------+---------+

-- Les trois suivants...
SELECT * FROM employes LIMIT 6, 3;
+-------------+-----------+----------+------+------------+---------------+---------+
| id_employes | prenom    | nom      | sexe | service    | date_embauche | salaire |
+-------------+-----------+----------+------+------------+---------------+---------+
|         547 | Melanie   | Collier  | f    | commercial | 2012-01-08    |    3100 |
|         592 | Laura     | Blanchet | f    | direction  | 2012-05-09    |    4500 |
|         627 | Guillaume | Miller   | m    | commercial | 2012-07-02    |    1900 |
+-------------+-----------+----------+------+------------+---------------+---------+

-- Je peux ne pas spécifier l'offset, mais simplement le nombre de lignes souhaitées
SELECT * FROM employes LIMIT 3; 

-- Ci dessous, la syntaxe de PostgreSQL, on peut l'utiliser aussi en MySQL ! 
SELECT * FROM employes LIMIT 3 OFFSET 0;


-- Affichage des employés avec leur salaire annuel 
SELECT nom, prenom, service, salaire * 12 FROM employes;
SELECT nom, prenom, service, salaire * 12 AS salaire_annuel FROM employes;
+----------+-------------+---------------+----------------+
| nom      | prenom      | service       | salaire_annuel |
+----------+-------------+---------------+----------------+
| Laborde  | Jean-pierre | direction     |          60000 |
| Gallet   | Clement     | commercial    |          27600 |
| Winter   | Thomas      | commercial    |          42600 |
| Dubar    | Chloe       | production    |          22800 |
| Fellier  | Elodie      | secretariat   |          19200 |
| Grand    | Fabrice     | comptabilite  |          34800 |
| Collier  | Melanie     | commercial    |          37200 |
| Blanchet | Laura       | direction     |          54000 |
| Miller   | Guillaume   | commercial    |          22800 |
| Perrin   | Celine      | commercial    |          32400 |
| Cottet   | Julien      | secretariat   |          16680 |
| Vignal   | Mathieu     | informatique  |          30000 |
| Desprez  | Thierry     | secretariat   |          18000 |
| Thoyer   | Amandine    | communication |          25200 |
| Durand   | Damien      | informatique  |          27000 |
| Chevel   | Daniel      | informatique  |          37200 |
| Martin   | Nathalie    | juridique     |          42600 |
| Lagarde  | Benoit      | production    |          30600 |
| Sennard  | Emilie      | commercial    |          21600 |
| Lafaye   | Stephanie   | assistant     |          21300 |
+----------+-------------+---------------+----------------+
-- AS nous permet de donner un surnom à la colonne lors de la récupération.


--------------------- Fonctions d'agrégation ------------------------------------

-- SUM() pour avoir la somme 
-- La masse salariale annuelle de l'entreprise 
SELECT SUM(salaire * 12) AS masse_salariale FROM employes;
+-----------------+
| masse_salariale |
+-----------------+
|          623580 |
+-----------------+

-- AVG() la moyenne
-- Affichage du salaire moyen de l'entreprise 
SELECT AVG(salaire) AS salaire_moyen FROM employes;
+---------------+
| salaire_moyen |
+---------------+
|       2598.25 |
+---------------+

-- ROUND() pour arrondir 
-- ROUND(valeur) => arrondi à l'entier 
-- ROUND(valeur, 1) => arrondi avec une décimale
SELECT ROUND(AVG(salaire), 1) AS salaire_moyen FROM employes;

-- COUNT() permet de compter le nombre de ligne d'une requête 
-- Le nombre d'employés dans l'entreprise : 
SELECT COUNT(*) AS nombre_employes FROM employes; -- COUNT() va faire un +1 pour chaque ligne de résultat 
+-----------------+
| nombre_employes |
+-----------------+
|              20 |
+-----------------+

-- Le nombre de ocmmerciaux
SELECT COUNT(*) AS nombre_commerciaux FROM employes WHERE service = "commercial";


-- MIN() & MAX()
-- salaire minimum 
SELECT MIN(salaire) FROM employes;
+--------------+
| MIN(salaire) |
+--------------+
|         1390 |
+--------------+
-- salaire maximum 
SELECT MAX(salaire) FROM employes;
+--------------+
| MAX(salaire) |
+--------------+
|         5000 |
+--------------+

-- EXERCICE : Affichez le salaire minimum ainsi que le prénom de l'employé ayant ce salaire (simultanément dans une seule requête)
SELECT MIN(salaire), prenom FROM employes; -- Pas bon ! Cela me donne le mauvais prénom 
-- ATTENTION les fonctions d'agrégation comme MIN ne peuvent renvoyer qu'un seul résultat ! (une seule ligne) 
-- Ici cela récupère le salaire minimum ainsi que les informations de la première ligne trouvée par la requête (pas de condition ici donc ça nous sort JP Laborde, le premier enregistrement)

-- 1 - Requete imbriquée
SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

-- 2 - Avec un Order By et un LIMIT 
SELECT prenom, salaire FROM employes ORDER BY salaire LIMIT 1;

-- IN & NOT IN pour tester plusieurs valeurs 
-- Affichage des employes des services commercial et comptabilite 
SELECT * FROM employes WHERE service = "commercial" OR service = "comptabilite";
SELECT * FROM employes WHERE service IN ('commercial', 'comptabilite');
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         388 | Clement   | Gallet  | m    | commercial   | 2010-12-15    |    2300 |
|         415 | Thomas    | Winter  | m    | commercial   | 2011-05-03    |    3550 |
|         509 | Fabrice   | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
|         547 | Melanie   | Collier | f    | commercial   | 2012-01-08    |    3100 |
|         627 | Guillaume | Miller  | m    | commercial   | 2012-07-02    |    1900 |
|         655 | Celine    | Perrin  | f    | commercial   | 2012-09-10    |    2700 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+--------------+---------------+---------+
-- L'inverse avec NOT IN 
SELECT * FROM employes WHERE service NOT IN ('commercial', 'comptabilite');
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Plusieurs conditions : AND 
-- On veut un employe du service commercial avec un salaire inférieur ou égal à 2000 
SELECT * 
FROM employes 
WHERE service = "commercial" 
AND salaire <= 2000;
+-------------+-----------+---------+------+------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service    | date_embauche | salaire |
+-------------+-----------+---------+------+------------+---------------+---------+
|         627 | Guillaume | Miller  | m    | commercial | 2012-07-02    |    1900 |
|         933 | Emilie    | Sennard | f    | commercial | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+------------+---------------+---------+

-- L'un ou l'autre d'un ensemble de conditions : OR 
-- Je veux un employé du service production ayant un salaire égal à 1900 ou 2300...
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR salaire = 2300; -- Ici pas bon ! le système ne comprends pas bien le lien entre nos conditions AND OR
SELECT * FROM employes WHERE service = "production" AND (salaire = 1900 OR salaire = 2300); -- Les parenthèses suffisent à lui faire comprendre la priorité des conditions
SELECT * FROM employes WHERE service = "production" AND salaire IN (1900,2300);
+-------------+--------+-------+------+------------+---------------+---------+
| id_employes | prenom | nom   | sexe | service    | date_embauche | salaire |
+-------------+--------+-------+------+------------+---------------+---------+
|         417 | Chloe  | Dubar | f    | production | 2011-09-05    |    1900 |
+-------------+--------+-------+------+------------+---------------+---------+

-- GROUP BY pour regrouper selon un ou plusieurs champs (généralement utilisé avec des fonctions d'agrégation)
-- Nombre d'employés par service 
SELECT COUNT(*), service FROM employes; -- Résultat Incorrect ! On fait un count() et il ne renvoie qu'un resultat (qu'une ligne)
+----------+-----------+
| COUNT(*) | service   |
+----------+-----------+
|       20 | direction |
+----------+-----------+

-- Avec GROUP BY, il est possible d'appliquer plusieurs fois une fonction d'agrégation dans une requête (plutôt que sur la totalité des lignes)
-- En quelque sortes, chaque "bloc" de service est extrait du résultat de base et la fonction d'agreg s'applique à chaque bloc séparément 
SELECT COUNT(*) AS nombre_employes, service FROM employes GROUP BY service;
+-----------------+---------------+
| nombre_employes | service       |
+-----------------+---------------+
|               2 | direction     |
|               6 | commercial    |
|               2 | production    |
|               3 | secretariat   |
|               1 | comptabilite  |
|               3 | informatique  |
|               1 | communication |
|               1 | juridique     |
|               1 | assistant     |
+-----------------+---------------+

-- SELECT * FROM employes ORDER BY service;
-- +-------------+-------------+----------+------+---------------+---------------+---------+
-- | id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
-- +-------------+-------------+----------+------+---------------+---------------+---------+
-- |         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |

-- |         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 |
-- |         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
-- |         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
-- |         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
-- |         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
-- |         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |

-- |         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |

-- |         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |

-- |         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
-- |         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |

-- |         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
-- |         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
-- |         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |

-- |         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |

-- |         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
-- |         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |

-- |         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
-- |         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
-- |         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
-- +-------------+-------------+----------+------+---------------+---------------+---------+

-- Il est possible de rajouter une condition spécifique aux GROUP BY : HAVING (ayant) 
-- Nombre d'employés par service mais uniquement pour les services ayant plus de deux employés 
SELECT COUNT(*), service FROM employes GROUP BY service HAVING COUNT(*) > 2;
+----------+--------------+
| COUNT(*) | service      |
+----------+--------------+
|        6 | commercial   |
|        3 | secretariat  |
|        3 | informatique |
+----------+--------------+


--------------------------------------------------------------------------
--------------------------------------------------------------------------
------ REQUETES D'INSERTION (Action : enregistrement) --------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, service, date_embauche) VALUES (NULL, "Pierra", "Lacaze", 2000, "m", "web", CURDATE());


INSERT INTO employes ( prenom, nom, salaire, sexe, service, date_embauche) VALUES ("Pierra", "Lacaze", 2000, "m", "web", CURDATE());


-- Il est possible de ne pas préciser les champs. En revanche, on est dans ce cas obligé de donner autant de valeur qu'il y a de champs dans la table et les valeurs doivent avoir le meme ordre que les colonnes de la table.
INSERT INTO employes VALUES (NULL, "Pierra", "Lac", "m", "Web", CURDATE(), 3000);


--------------------------------------------------------------------------
--------------------------------------------------------------------------
------ REQUETES DE MODIFICATION (Action : modification) ------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

-- On modifie le salaire d'un employe 
UPDATE employes SET salaire = 1000 WHERE id_employes = 991;
-- On peut faire plusieurs modifications 
UPDATE employes SET salaire = 1000, service = "informatique" WHERE id_employes = 992;


-- REPLACE 
-- Dans le cas d'une nouvelle valeur, le REPLACE se comporte comme un INSERT INTO 
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "formation", "2020-01-01", 3000);
-- Si je relance sur un enregistrement existant, cela va le modifier...
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "formation", "2020-01-01", 4000);

-- ATTENTION : NE JAMAIS UTILISER REPLACE 
    -- En fait, REPLACE INTO ne modifie pas un enregistrement, il le supprime pour le réinsérer ! 
        -- TRES GRAVE sur une base possedant des relations en CASCADE entre ses tables (CASCADE = réaction en chaine, pourrait supprimer des centaines/milliers d'autres enregistrement alors que l'on a souhaité simplement faire une modification !... :(   ))


--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- REQUETES DE SUPPRESSION (Action : Supprimer)
--------------------------------------------------------------------------
--------------------------------------------------------------------------
DELETE FROM employes; -- Cette requête supprime toutes les données de la table 

-- SUppression avec condition, on supprime les enregistrement trouvés 
DELETE FROM employes WHERE id_employes = 991;
DELETE FROM employes WHERE id_employes > 990;

DELETE FROM employes WHERE service = "commercial" AND salaire < 2000;


--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- EXERCICES :
--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- 1 -- Afficher la profession de l'employé 547.
-- 2 -- Afficher la date d'embauche d'Amandine.	
-- 3 -- Afficher le nom de famille de Guillaume	
-- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
-- 5 -- Afficher le nombre de commerciaux.
-- 6 -- Afficher le salaire moyen des informaticiens 	
-- 7 -- Afficher les 5 premiers employés après avoir classé leur nom de famille par ordre alphabétique. 
-- 8 -- Afficher le coût des commerciaux sur 1 année.		
-- 9 -- Afficher le salaire moyen par service. 
-- 10 -- Afficher le nombre de recrutement sur l'année 2010 	
-- 11 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 a 2017
-- 12 -- Afficher le nombre de service différent 
-- 13 -- Afficher tous les employés sauf ceux du service production et secrétariat
-- 14 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
-- 15 -- Afficher les commerciaux ayant été recrutés avant 2012 de sexe masculin et gagnant un salaire supérieur a 2500 €
-- 16 -- Qui a été embauché en dernier 
-- 17 -- Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé 
-- 18 -- Afficher le prénom du comptable gagnant le meilleur salaire
-- 19 -- Afficher le prénom de l'informaticien ayant été recruté en premier
-- 20 -- Augmenter chaque employé de 100 €
-- 21 -- Supprimer les employés du service secrétariat




