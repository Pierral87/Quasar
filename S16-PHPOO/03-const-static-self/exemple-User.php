<?php

/* 

1. const : Utilisation concrète dans le développement web

Les constantes (const) sont souvent utilisées pour définir des valeurs immuables qui ne changent pas pendant l'exécution du script. 

Exemple  : Gestion des rôles utilisateurs

Imaginons que l'on développe un système de gestion d'utilisateurs où certains rôles sont fixes, comme "ADMIN", "EDITOR", "USER", etc. Plutôt que d'utiliser des chaînes de caractères dispersées dans le code, on peut définir ces rôles comme des constantes dans une classe (même système dans Symfony/Laravel).

Ici, const nous permet de garder des valeurs constantes (les rôles d'utilisateur) bien organisées et de les réutiliser facilement à travers notre code sans risque d'erreur de frappe.

*/
class User {
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EDITOR = 'editor';
    public const ROLE_USER = 'user';

    private $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function getRole() {
        return $this->role;
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }
}

// Utilisation
$user = new User(User::ROLE_ADMIN);
echo $user->isAdmin() ? 'Cet utilisateur est un admin' : 'Cet utilisateur n\'est pas un admin';
?>
