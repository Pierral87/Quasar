<?php 

// Ici au lieu de faire tous les requires de mon projet, je lance simplement l'autoload 

require('autoload.php');

// A partir de là, j'appelle directement les classes dont j'ai besoin, l'autoload se charge de les ajouter à la page 

$article = new Article;