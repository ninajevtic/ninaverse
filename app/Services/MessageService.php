<?php

namespace App\Services;

use PDO;
use Core\Database;

class MessageService implements ServiceInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * GET /messages
     */
    public function index(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Messages WHERE deleted_at IS NULL ORDER BY created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * GET /messages/{id}
     */
    public function show(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Messages WHERE message_id = :message_id AND deleted_at IS NULL"
        );
        $stmt->execute(['message_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * POST /messages
     */
    public function store(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Messages (chat_id, sender_id, content, created_at) VALUES (:chat_id, :sender_id, :content, NOW())"
        );
        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to create message in the database.");
        }
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * PUT/PATCH /messages/{id}
     */
    public function update(int $id, array $data): bool
    {
        $data['message_id'] = $id;
        $stmt = $this->pdo->prepare(
            "UPDATE Messages SET content = :content WHERE message_id = :message_id AND deleted_at IS NULL"
        );
        if (!$stmt->execute($data)) {
            throw new \Exception("Failed to update message in the database.");
        }
        return true;
    }

    /**
     * DELETE /messages/{id}
     */
    public function destroy(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE Messages SET deleted_at = NOW() WHERE message_id = :message_id"
        );
        if (!$stmt->execute(['message_id' => $id])) {
            throw new \Exception("Failed to delete message.");
        }
        return true;
    }

    // Specifični metod za poruke u određenom chatu
    public function getMessagesByChat(int $chatId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Messages WHERE chat_id = :chat_id AND deleted_at IS NULL ORDER BY created_at DESC"
        );
        $stmt->execute(['chat_id' => $chatId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}
