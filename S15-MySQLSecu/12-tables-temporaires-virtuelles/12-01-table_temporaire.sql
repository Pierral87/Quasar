-------------------------- TABLES TEMPORAIRES ------------------

USE entreprise;
DELIMITER $ 
CREATE TEMPORARY TABLE commerciaux  AS SELECT * FROM employes WHERE service='commercial' $

USE bibliotheque;
DELIMITER $ 
CREATE TEMPORARY TABLE emprunt2014 AS SELECT * FROM emprunt WHERE date_sortie LIKE '2014%' AND date_rendu LIKE '2014%' $

SHOW TABLES $ -- les tables temporaires ne sont pas visibles, pourtant bien accessibles

-- une table temporaire se construit à partir d'une requête et de colonnes de tables existantes.
-- une table temporaire est pratique pour isoler des résultats suite à une jointure compliquée, cela permettra de faire des requêtes plus simple directement sur les résultats de la jointure, et aussi pour isoler une "portion" de résultats (Optimisation : Par exemple, cela permet de lancer des requêtes seulement sur les commerciaux de l'entreprise du fait qu'ils soient isolés et non pas sur tous les employés, il peut être utile de l'utiliser pour créer un sous-ensemble d'une autre table plus léger afin de soulager le serveur).

-- une table temporaire peut permettre de masquer certains aspects du schéma (confidentialité) ou d'en changer la complexité en montrant que certaines colonnes
-- une table temporaire possède ses propres données (si je change un commercial dans la table temporaire commerciaux, ça ne change pas le reste de la table employes)
-- une table temporaire est supprimée automatiquement lorsque l'on ferme la console (durée de vie lié à la session en cours)
