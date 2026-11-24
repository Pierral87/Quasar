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

class Config {
    // Constante définissant le nom de l'application
    const APP_NAME = "Mon Application Web";

    // Paramètres globaux
    protected static $settings = [
        'debug' => true,
        'database' => 'mysql:host=localhost;dbname=mydb',
    ];

    // Méthode pour définir un paramètre
    public static function setSetting(string|int $key, mixed $value) {
        self::$settings[$key] = $value;
    }

    // Méthode pour obtenir un paramètre
    public static function getSetting(string|int $key) {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    // Méthode pour obtenir le nom de l'application
    public static function getAppName() {
        return self::APP_NAME;
    }
}

// Utilisation
echo "Nom de l'application : " . Config::getAppName() . "<br>";
echo "Mode debug : " . (Config::getSetting('debug') ? 'activé' : 'désactivé') . "<br>";

// Mise à jour des paramètres
Config::setSetting('debug', false);
echo "Mode debug après mise à jour : " . (Config::getSetting('debug') ? 'activé' : 'désactivé') . "<br>";
?>