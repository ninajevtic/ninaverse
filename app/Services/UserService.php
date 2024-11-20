<?php

namespace App\Services;

use App\Interface\ServiceInterface;
use Core\Database;
use PDO;

class UserService implements ServiceInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * GET /users
     */
    public function index(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Users WHERE deleted_at IS NULL AND is_verified = 1 ORDER BY name DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * GET /users/{id}
     */
    public function show(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Users WHERE user_id = :user_id AND deleted_at IS NULL"
        );
        $stmt->execute(['user_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * POST /users
     */
    public function store(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Users (name, email, password_hash) VALUES (:name, :email, :password_hash)"
        );

        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to create user in the database.");
        }

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * PUT/PATCH /users/{id}
     */
    public function update(int $id, array $data): bool
    {
        $data['user_id'] = $id;
        $stmt = $this->pdo->prepare(
            "UPDATE Users SET name = :name, email = :email, password_hash = :password_hash WHERE user_id = :user_id"
        );

        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to update user in the database.");
        }

        return true;
    }

    /**
     * DELETE /users/{id}
     */
    public function destroy(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE Users SET deleted_at = NOW() WHERE user_id = :user_id"
        );

        if (!$stmt->execute(['user_id' => $id])) {
            throw new \Exception("Failed to delete user.");
        }

        return true;
    }

    // Dodajte još metoda prema potrebama
}
