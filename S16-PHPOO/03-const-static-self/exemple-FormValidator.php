<?php

/*

Exemple 2 : Classe de validation des formulaires

Une autre utilisation de static serait dans une classe qui valide des formulaires. On veut pouvoir réutiliser la validation partout sans instancier de classe à chaque fois.

Ici, static est utilisée pour valider des formulaires de manière rapide et sans avoir à instancier la classe à chaque appel. Cela rend le code plus simple et plus efficace.
*/
class FormValidator {
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isRequired($value) {
        return !empty($value);
    }
}

// Utilisation
$email = "test@example.com";
if (FormValidator::isEmail($email)) {
    echo "Email valide.";
} else {
    echo "Email invalide.";
}
?>