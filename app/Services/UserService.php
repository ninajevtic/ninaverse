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

    public function getUsers(): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Users WHERE deleted_at IS NULL AND is_verified = 1 ORDER BY name DESC"
        );
        $stmt->execute();
        return $stmt->fetch() ?: null;
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
        //return $stmt->execute($userData);
        // Try executing the statement, and throw exception if it fails.
        if (!$stmt->execute($userData)) {
            throw new \Exception("Failed to create user in the database.");
        }

        return true;
    }
    // Dodajte još metoda prema potrebama
}
