CREATE DATABASE bibliotheque_quasar;
USE bibliotheque_quasar;

CREATE TABLE abonne (
  id_abonne INT(3) NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(15) NOT NULL,
  PRIMARY KEY (id_abonne)
) ENGINE=InnoDB ;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');


CREATE TABLE livre (
  id_livre INT(3) NOT NULL AUTO_INCREMENT,
  auteur VARCHAR(25) NOT NULL,
  titre VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_livre)
) ENGINE=InnoDB ;

INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');

CREATE TABLE emprunt (
  id_emprunt INT(3) NOT NULL AUTO_INCREMENT,
  id_livre INT(3) DEFAULT NULL,
  id_abonne INT(3) DEFAULT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE DEFAULT NULL,
  PRIMARY KEY  (id_emprunt)
) ENGINE=InnoDB ;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2016-12-07', '2016-12-11'),
(2, 101, 2, '2016-12-07', '2016-12-18'),
(3, 100, 3, '2016-12-11', '2016-12-19'),
(4, 103, 4, '2016-12-12', '2016-12-22'),
(5, 104, 1, '2016-12-15', '2016-12-30'),
(6, 105, 2, '2017-01-02', '2017-01-15'),
(7, 105, 3, '2017-02-15', NULL),
(8, 100, 2, '2017-02-20', NULL);

-- Quels sont les id_livres des livres qui n'ont pas été rendu à la bibliothèque ? 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- NULL se teste avec IS NULL ou IS NOT NULL 
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+

-- Pour avoir les titres des livres, ces informations étant sur une autre table, j'ai deux possibilités : 
-- Requêtes Imbriquées
-- Requêtes en Jointure


--------------------------------------------------------------------------------
--------------------------------------------------------------------------------
------------ REQUETES IMBRIQUEES (sur plusieurs tables) ------------------------
--------------------------------------------------------------------------------
--------------------------------------------------------------------------------

-- QUels sont les titres des livres qui n'ont pas été rendu à la bibliotheque ? 
-- Les requêtes imbriquées s'executent si on voulait se l'imaginer, de façon logique, par la fin.
-- On a besoin du résultat de la "sous requete" pour mener à bien la requête de premier niveau 

SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+

-- EXERCICE 1: Quels sont les prénoms des abonnés n'ayant pas rendu un livre à la bibliotheque.
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);
    +--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+
-- EXERCICE 2 : Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
SELECT id_livre FROM emprunt WHERE id_abonne IN 
    (SELECT id_abonne FROM abonne WHERE prenom = "Chloe");
    +----------+
| id_livre |
+----------+
|      100 |
|      105 |
+----------+
-- EXERCICE 3: Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE date_sortie = "2016-12-07");
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+
-- EXERCICE 4: combien de livre Guillaume a emprunté à la bibliotheque ?
SELECT COUNT(*) AS nbr_emprunts FROM emprunt WHERE id_abonne IN 
    (SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
+--------------+
| nbr_emprunts |
+--------------+
|            2 |
+--------------+
-- EXERCICE 5: Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE id_livre IN 
        (SELECT id_livre FROM livre WHERE auteur = "Alphonse Daudet"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+
-- EXERCICE 6: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
-- EXERCICE 7: Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre NOT IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-----------------+
| titre           |
+-----------------+
| Bel-Ami         |
| Le pere Goriot  |
| Le Petit chose  |
| La Reine Margot |
+-----------------+
-- EXERCICE 8: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Les Trois Mousquetaires |
+-------------------------+
-- EXERCICE 9 :  Qui a emprunté le plus de livre à la bibliotheque ?
SELECT prenom FROM abonne WHERE id_abonne = 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1);
+--------+
| prenom |
+--------+
| Benoit |
+--------+

-- La requête ci dessus est fonctionnelle mais ne permet pas de sortir plus d'un prénom
-- Il existe une exception, s'ils sont plusieurs abonnés à avoir emprunté le même nombre d'emprunts 

-- Pour gérer ça, il faudra utiliser une table temporaire pour le calcul, voir la requete ci dessous 
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
        (SELECT MAX(nombre_emprunts) FROM 
            (SELECT COUNT(*) AS nombre_emprunts FROM emprunt GROUP BY id_abonne) AS statistiques));


-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------
----------------------------- REQUETES EN JOINTURE ----------------------------------------
-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------

-- Une jointure est toujours possible 
-- Une imbriquée est possible uniquement si les champs que l'on récupère (les champs que l'on select) proviennent d'une seule table 

-- Avec des requêtes imbriquées, on parcourt les tables les unes après les autres en passant toujours par le champ commun PK/FK
-- Avec des requêtes en jointure, on mélange les champs de sorties, les tables, les conditions sans que cela pose problème 

-- Nous aimerions connaitre les dates de sortie et les dates de rendu pour l'abonnée Guillaume 
    -- En imbriquée, je ne pourrais pas afficher en même temps les dates et le prenom de l'abonné car ce sont des champs qui proviennent de deux tables différentes 

SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu   -- Ce que je veux afficher, de plusieurs tables différentes 
FROM emprunt, abonne                                            -- Les tables que j'ai besoin de manipuler
WHERE abonne.prenom = "Guillaume"                               -- Ma/mes conditions (ici prénom Guillaume)
AND abonne.id_abonne = emprunt.id_abonne;                       -- La création de la jointure

-- Lorsqu'un champ a le meme nom sur plusieurs tables, il faut préciser la table en préfixe 

-- Même requête mais avec des alias pour les noms des tables (pour les prefixes)

SELECT a.prenom, e.date_sortie, et.date_rendu   
FROM emprunt e, abonne a                                           
WHERE a.prenom = "Guillaume"                               
AND a.id_abonne = e.id_abonne; 

-- Autres syntaxes pour les jointures 
-- En utilisant INNER JOIN ou JOIN 
-- Avec cette méthode on joint les tables une par une 
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
INNER JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
JOIN abonne a ON e.id_abonne = a.id_abonne     
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
JOIN abonne a USING (id_abonne)    -- Ici on peut utiliser USING uniquement si le PK et FK ont exactement le même nom
WHERE a.prenom = "Guillaume";


-- EXERCICE 1 : Nous aimerions connaitre les dates de sortie et les dates de rendu pour les livres écrit par Alphonse Daudet 
SELECT e.date_sortie, e.date_rendu, l.titre
FROM emprunt e 
INNER JOIN livre l  ON e.id_livre = l.id_livre 
WHERE l.auteur = "Alphonse Daudet";
+-------------+------------+----------------+
| date_sortie | date_rendu | titre          |
+-------------+------------+----------------+
| 2016-12-12  | 2016-12-22 | Le Petit chose |
+-------------+------------+----------------+
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016
SELECT a.prenom 
FROM emprunt e
JOIN abonne a ON e.id_abonne = a.id_abonne 
JOIN livre l ON e.id_livre = l.id_livre 
WHERE l.titre = "Une vie"
AND YEAR(date_sortie) = 2016;
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Chloe     |
+-----------+
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
SELECT a.prenom, COUNT(*) AS nb_emprunts 
FROM abonne a 
JOIN emprunt e ON a.id_abonne = e.id_abonne 
GROUP BY a.prenom;
+-----------+-------------+
| prenom    | nb_emprunts |
+-----------+-------------+
| Guillaume |           3 |
| Benoit    |           3 |
| Chloe     |           2 |
| Laura     |           1 |
+-----------+-------------+
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné 
SELECT a.prenom, COUNT(e.id_emprunt) AS nbr_a_rendre 
FROM emprunt e 
JOIN abonne a USING(id_abonne)
WHERE e.date_rendu IS NULL 
GROUP BY a.id_abonne 
ORDER BY nbr_a_rendre DESC;
+-----------+--------------+
| prenom    | nbr_a_rendre |
+-----------+--------------+
| Chloe     |            1 |
| Benoit    |            1 |
| Guillaume |            1 |
+-----------+--------------+
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?
SELECT a.prenom, l.titre, e.date_sortie 
FROM emprunt e 
JOIN abonne a ON e.id_abonne = a.id_abonne 
JOIN livre l ON e.id_livre = l.id_livre
ORDER BY prenom;
+-----------+-------------------------+-------------+
| prenom    | titre                   | date_sortie |
+-----------+-------------------------+-------------+
| Benoit    | Bel-Ami                 | 2016-12-07  |
| Benoit    | Les Trois Mousquetaires | 2017-01-02  |
| Benoit    | Une vie                 | 2017-02-20  |
| Chloe     | Une vie                 | 2016-12-11  |
| Chloe     | Les Trois Mousquetaires | 2017-02-15  |
| Guillaume | Une vie                 | 2016-12-07  |
| Guillaume | La Reine Margot         | 2016-12-15  |
| Guillaume | Une vie                 | 2026-10-27  |
| Laura     | Le Petit chose          | 2016-12-12  |
+-----------+-------------------------+-------------+


-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------
------------ JOINTURE EXTERNE (sans correspondance exigée) --------------------------------
-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------

-- Enregistrez-vous dans la table abonné 
INSERT INTO abonne (prenom) VALUES ("Pierra");
SELECT * FROM abonne;


-- Affichez tous les prénoms des abonnés SANS EXCEPTION ainsi que les id_livre qu'ils ont emprunté si ils ont emprunté des livres 
SELECT a.prenom, e.id_livre 
FROM abonne a 
JOIN emprunt e USING(id_abonne);
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Guillaume |      100 |
| Benoit    |      101 |
| Chloe     |      100 |
| Laura     |      103 |
| Guillaume |      104 |
| Benoit    |      105 |
| Chloe     |      105 |
| Benoit    |      100 |
| Guillaume |      100 |
+-----------+----------+

-- Avec ces requetes, nous n'apparaissont pas dans le resultat (le nouvel inscrit sans emprunt)
-- C'est normal car nous n'avons pas encore de correspondance sur la table emprunt
-- Pour récupérer l'intégralité d'une table et obtenir toutes les informations de cette table tout en rajoutant les correspondances s'il y en a, nous appellons ça une jointure EXTERNE

-- ATTENTION les jointures ont un sens !!! 
-- On peut faire une jointure externe avec un LEFT JOIN ou avec un RIGHT JOIN 
-- La table au bout du sens de la jointure sera celle incluse en entier dans le résultat 
SELECT a.prenom, e.id_livre 
FROM abonne a LEFT JOIN emprunt e USING(id_abonne); -- Ici avec un EFT JOIN on considère que c'est de la table abonné que l'on souhaite l'entièreté des informations (meme si pas de correspondance dans la table emprunt)
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Guillaume |      100 |
| Guillaume |      104 |
| Guillaume |      100 |
| Benoit    |      100 |
| Benoit    |      105 |
| Benoit    |      101 |
| Chloe     |      105 |
| Chloe     |      100 |
| Laura     |      103 |
| Pierra    |     NULL |
+-----------+----------+
SELECT a.prenom, e.id_livre 
FROM emprunt e RIGHT JOIN abonne a USING(id_abonne); -- (même chose mais écrit dans l'autre sens ! Avec un RIGHT JOIN)

-- Jointe externe en excluant l'intersection (donc, que les abonnés sans emprunts)
SELECT a.prenom 
FROM abonne a LEFT JOIN emprunt e USING (id_abonne) 
WHERE id_emprunt IS NULL;

-- EXERCICE 1 : Affichez tous les livres sans exception puis les id_abonne ayant emprunté ces livres si c'est le cas
SELECT l.titre, e.id_abonne 
FROM livre l LEFT JOIN emprunt e USING (id_livre);
+-------------------------+-----------+
| titre                   | id_abonne |
+-------------------------+-----------+
| Une vie                 |         1 |
| Une vie                 |         2 |
| Une vie                 |         3 |
| Une vie                 |         1 |
| Bel-Ami                 |         2 |
| Le pere Goriot          |      NULL |
| Le Petit chose          |         4 |
| La Reine Margot         |         1 |
| Les Trois Mousquetaires |         3 |
| Les Trois Mousquetaires |         2 |
+-------------------------+-----------+

-- EXERCICE 2 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre
SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a LEFT JOIN emprunt e USING(id_abonne) LEFT JOIN livre l USING (id_livre);
+-----------+----------+-------------------+-------------------------+
| prenom    | id_livre | auteur            | titre                   |
+-----------+----------+-------------------+-------------------------+
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Guillaume |      104 | ALEXANDRE DUMAS   | La Reine Margot         |
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Benoit    |      101 | GUY DE MAUPASSANT | Bel-Ami                 |
| Chloe     |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Chloe     |      100 | GUY DE MAUPASSANT | Une vie                 |
| Laura     |      103 | ALPHONSE DAUDET   | Le Petit chose          |
| Pierra    |     NULL | NULL              | NULL                    |
+-----------+----------+-------------------+-------------------------+

-- EXERCICE 3 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre ainsi que les livres non empruntés :)
SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a LEFT JOIN emprunt e USING(id_abonne) LEFT JOIN livre l USING (id_livre)
UNION
SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a RIGHT JOIN emprunt e USING(id_abonne) RIGHT JOIN livre l USING (id_livre);
+-----------+----------+-------------------+-------------------------+
| prenom    | id_livre | auteur            | titre                   |
+-----------+----------+-------------------+-------------------------+
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Guillaume |      104 | ALEXANDRE DUMAS   | La Reine Margot         |
| Benoit    |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Benoit    |      101 | GUY DE MAUPASSANT | Bel-Ami                 |
| Chloe     |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Chloe     |      100 | GUY DE MAUPASSANT | Une vie                 |
| Laura     |      103 | ALPHONSE DAUDET   | Le Petit chose          |
| Pierra    |     NULL | NULL              | NULL                    |
| NULL      |     NULL | HONORE DE BALZAC  | Le pere Goriot          |
+-----------+----------+-------------------+-------------------------+