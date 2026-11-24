<?php 

/* 

Exercice 1 : Configuration d'une classe Config avec static, self et const

Objectif : Créer une classe Config pour gérer la configuration générale d'une application web. Cette classe contiendra des constantes et des méthodes statiques permettant d'accéder aux informations comme le nom de l'application et les paramètres globaux.

Énoncé :

    Créez une classe Config qui contiendra :
        Une constante APP_NAME qui stockera le nom de l'application.
        Une propriété protected statique $settings qui contiendra les paramètres globaux de l'application sous forme de key=>value (comme le mode de débogage, ou l'URL de la base de données, mettez des infos aléatoires).
        Une méthode statique setSetting($key, $value) pour ajouter une valeur dans $settings.
        Une méthode statique getSetting($key) pour récupérer une valeur de $settings.
        Une méthode statique getAppName() qui retourne le nom de l'application.

*/ 