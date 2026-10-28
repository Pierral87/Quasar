------------------ REQUETE PREPAREE ---------------------------------

-- Les requêtes préparées sont un concept présent dans les SGBD qui nous permettent de ne pas executer la requête immédiatement mais de plutôt passer par plusieurs cycles d'analyses et interpertretation avant l'execution

-- En gros, on défini la requête à lancer avec des "trous" c'est à dire des zones dans laquelle on collera des valeurs/variables 
-- Le système lui va automatiquement filtrer les valeurs dans un type choisi (généralement en string), ainsi toute instruction qui seraient envoyées dans la requête ne sera pas interprétée
-- C'est ce qui nous protège des injections SQL ! 
-- Pour finir, la requête est exécutée 


-- Ci dessous une requête lancée automatiquement avec potentiellement des saisies utilisateurs et peut être une injection SQL....
INSERT INTO users (pseudo, password, email) VALUES ("$pseudo", "$password", ""'); DROP TABLE users;  '");

saisie user : "); DROP TABLE users;     

-- Ci dessous, la même requête gérée en requête préparée
-- Chaque point d'interrogation symbolise une valeur attendue dans la requête 
PREPARE req1 FROM "INSERT INTO users (pseudo, password, email) VALUES (?, ?, ?)";
SET @pseudo = "Pierro";
SET @password = "azerty";   -- Ici je défini mes valeurs dans des variables MySQL (généralement cela vient plutot de notre langage back end)
SET @email = "pierro@mail.com";
EXECUTE req1 USING @pseudo, @password, @email; -- Pour finir, j'execute la requête en transmettant les valeurs 

-- Grâce aux requêtes préparées, je suis directement protégé des injections SQL :) 