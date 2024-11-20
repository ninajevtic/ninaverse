<?php

namespace App\Services;

use PDO;
use Core\Database;

class ChatService
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * GET /chats
     */
    public function index(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Chats WHERE deleted_at IS NULL ORDER BY created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * GET /chats/{id}
     */
    public function show(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Chats WHERE chat_id = :chat_id AND deleted_at IS NULL"
        );
        $stmt->execute(['chat_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * POST /chats
     */
    public function store(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Chats (name, created_at) VALUES (:name, NOW())"
        );

        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to create chat in the database.");
        }

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * PUT/PATCH /chats/{id}
     */
    public function update(int $id, array $data): bool
    {
        $data['chat_id'] = $id;
        $stmt = $this->pdo->prepare(
            "UPDATE Chats SET name = :name WHERE chat_id = :chat_id AND deleted_at IS NULL"
        );

        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to update chat in the database.");
        }

        return true;
    }

    /**
     * DELETE /chats/{id}
     */
    public function destroy(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE Chats SET deleted_at = NOW() WHERE chat_id = :chat_id"
        );

        if (!$stmt->execute(['chat_id' => $id])) {
            throw new \Exception("Failed to delete chat.");
        }

        return true;
    }

    // Specifični metod za korisnike u chatu
    public function getParticipants(int $chatId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.user_id, u.name, u.email 
             FROM Users u
             JOIN ChatParticipants cp ON u.user_id = cp.user_id
             WHERE cp.chat_id = :chat_id AND u.deleted_at IS NULL"
        );
        $stmt->execute(['chat_id' => $chatId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function getChatsByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Chats WHERE created_by = :user_id"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function createChat(array $chatData): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Chats (name, chat_type, created_by) VALUES (:name, :chat_type, :created_by)"
        );
        return $stmt->execute($chatData);
    }
}
