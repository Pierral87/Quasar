<?php

namespace ProjetAdmin\Model;

require_once __DIR__ . "/../../partials/config.php";

class UserRepository
{

    private $db;

    public function getDb()
    {
        if (!$this->db) {
            try {
                $this->db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                ]);
            } catch (\PDOException $e) {
                echo 'Erreur de connexion à la BDD';
                exit();
            }
        }
        return $this->db;
    }

    public function __construct()
    {
        // $this->getDb();
        echo "<h2>Instanciation du Model UserRepository dans le Controller ! Je suis dans le construct du repository </h2>";
    }

    public function modelSelectAll() {
        return $this->getDb()->query("SELECT * FROM user")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function modelSelectOne($id) {
          return $this->getDb()->query("SELECT * FROM user WHERE id_user = $id")->fetch(\PDO::FETCH_ASSOC);
    }
}
