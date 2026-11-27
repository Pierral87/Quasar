<?php

use ProjetAdmin\Controller\UserController;

require "vendor/autoload.php"; // Ici on charge l'autoload de composer


echo "<h1>Bienvenue sur l'index MVC : </h1>";

$controller = new UserController;

$controller->handleRequest();