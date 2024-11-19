<?php

namespace App\Controllers;

use App\Models\Chat;
use App\Services\ChatService;
use App\Services\UserService;
use Core\DocumentManager;

class ChatController
{
    private $chatService;
    private $userService;

    public function __construct()
    {
        $this->chatService = new ChatService();
        $this->userService = new UserService();
        $this->documentManager = new DocumentManager();
    }

    public function index()
    {
        //$chats = $this->chatService->getChatsByUserId($_SESSION['user_id']);
        $users = $this->userService->getUsers();
//        $documentManager = new DocumentManager();
//        $documentManager->render('chat', [
//            //'chats' => $chats,
//            'users' => $users
//        ]);
//        $documentManager = new DocumentManager();
//        $documentManager->render('login', [
////            'csrfToken' => $_SESSION['csrf_token']
//        ]);
        $this->documentManager->loadComponent('login', ['csrfToken' => $_SESSION['csrf_token']]);
    }

    public function loadMoreConversations()
    {
        $documentManager = new DocumentManager();
        $additionalConversations = Chat::getAdditionalConversations(
            $_SESSION['user_id'],
            $_GET['offset']
        );
        $documentManager->render('components/conversations', [
            'conversations' => $additionalConversations
        ]);
    }
}