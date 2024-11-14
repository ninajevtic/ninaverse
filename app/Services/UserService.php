<?php

namespace App\Services;

use PDO;
use Core\Database;

class UserService
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findUserById(int $userId): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Users WHERE user_id = :user_id"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch() ?: null;
    }

    public function createUser(array $userData): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Users (name, email, password_hash) VALUES (:name, :email, :password_hash)"
        );
        return $stmt->execute($userData);
    }
    // Dodajte još metoda prema potrebama
}