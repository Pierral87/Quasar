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