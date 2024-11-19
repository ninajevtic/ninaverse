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
