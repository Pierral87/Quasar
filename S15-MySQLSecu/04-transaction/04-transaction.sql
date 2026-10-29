-- Les transactions sont possibles avec le moteur InnoDB
-- Les transactions nous permettent de créer une zone de staging afin d'exécuter un ensemble de requêtes puis de les valider ou non 
-- On s'en sert souvent dans le web lorsqu'une opération est composée de plusieurs requêtes qui sont liées mais quand on veut s'assurer qu'elles doivent toutes bien s'exécuter pour les valider. 
-- Par exemple, virement bancaire, je prends de l'argent à A  pour le donner à B, je ne donne pas à B si je n'ai pas réussi à enlever à A, je n'enlève pas à A si je n'ai pas réussi à donner à B, c'est une transaction.

-- Avec la console, cela nous permet de faire des tests de requêtes puis les valider ou les annuler 
-- Dans notre langage back, on pourra souvent gérer les transactions via des classes natives comme PDO en PHP et on englobe ça dans un try/catch 

USE entreprise_quasar;

START TRANSACTION; -- démarre une transaction 

SELECT * FROM employes; -- On vérifie nos données 

UPDATE employes SET salaire = +100; -- Ici je me trompe dans ma requête, oups ! Tous les salaires passent à 100 
-- Pas grave ! Je suis dans une transaction ! Je suis en capacité de faire un ROLLBACK pour annuler la transaction
-- Si c'était ok on pourrait faire un COMMIT pour valider 

ROLLBACK;
COMMIT;
-- ATTENTION un COMMIT comme un ROLLBACK clôture la transaction 


-- On imagine dans notre langage back avec du try catch 
-- $pdo; -- $pdo représente la BDD

-- try {
--     $pdo->beginTransaction();
--     $pdo->prepare("UPDATE employes SET salaire = salaire +100");
--     $pdo->execute();
--     $pdo->commit();
-- } catch (PDOException $e) {
--     echo "Problème de requête";
--     $pdo->rollback();
-- }


-- Il existe aussi des transactions avancées avec la possibilité de créer des SAVEPOINTS sur lesquels on pourra retourner sans clôturer la transaction (ce ne sont pas des transactions manipulables nativement avec PHP, donc on s'en sert peu)