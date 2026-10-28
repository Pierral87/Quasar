

-- UNION permet de fusionner des résultats en un seul.
-- ATTENTION, le nombre de champs attendus doit être le même dans les requetes concernées. (le nombre de colonnes)
-- UNION applique un DISTINCT par defaut pour ne pas avoir de doublons

SELECT prenom AS "Liste de gens" FROM abonne 
UNION 
SELECT auteur FROM livre;
+-------------------+
| Liste de gens     |
+-------------------+
| Guillaume         |
| Benoit            |
| Chloe             |
| Laura             |
| Pierra            |
| GUY DE MAUPASSANT |
| HONORE DE BALZAC  |
| ALPHONSE DAUDET   |
| ALEXANDRE DUMAS   |
+-------------------+

-- Pour avoir les doublons : 
-- UNION ALL 
SELECT prenom AS "Liste de gens" FROM abonne 
UNION ALL
SELECT auteur FROM livre;
+-------------------+
| Liste de gens     |
+-------------------+
| Guillaume         |
| Benoit            |
| Chloe             |
| Laura             |
| Pierra            |
| GUY DE MAUPASSANT |
| GUY DE MAUPASSANT |
| HONORE DE BALZAC  |
| ALPHONSE DAUDET   |
| ALEXANDRE DUMAS   |
| ALEXANDRE DUMAS   |
+-------------------+