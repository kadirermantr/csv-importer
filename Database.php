<?php

class Database
{
    protected PDO $pdo;

    public function __construct($host = 'localhost', $user = 'root', $pass = null, $database = 'mivento')
    {
        $this->pdo = new PDO("mysql:host=$host; dbname=$database;", $user, $pass);
    }

    public function insert(string $query, array $values): bool
    {
        $stmt = $this->pdo->prepare($query);

        foreach ($values as $field => $value) {
            $stmt->bindValue(':' . $field, $value);
        }

        return $stmt->execute();
    }
}