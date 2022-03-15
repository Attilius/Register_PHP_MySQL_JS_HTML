<?php

namespace htdocs\helio\server\src;

use PDO;

class Database 
{

    private $pdo;

    public function __construct($host, $dbName, $charset, $mysqlUser, $mysqlPass)
    {
        $this->pdo = new PDO('mysql:host='. $host . ';dbname=' . $dbName . ';charset=' . $charset, $mysqlUser, $mysqlPass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function registerUser(string $email, string $passwd) {
        $sql = "INSERT INTO users(email, passwd) VALUES(?, ?)";
        $query = $this->pdo->prepare($sql);
        $query->execute([$email, $passwd]);
    }

    public function loginUser(string $email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$email]);
        return $query->fetchAll();
    }
}