<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Services\ChatService;

class UserController
{
    private UserService $userService;
    private ChatService $chatService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->chatService = new ChatService();
    }

    public function showUser(int $userId)
    {
        $user = $this->userService->findUserById($userId);
        // Prikazivanje korisnika ili vraćanje kao odgovor
    }

    public function createChatForUser(int $userId, array $chatData)
    {
        $chatData['created_by'] = $userId;
        $this->chatService->createChat($chatData);
        // Kreirajte chat i vratite rezultat
    }
}