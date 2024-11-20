<?php

namespace App\Controllers;

use App\Services\ChatService;
use App\Services\UserService;
use Config\DomainConfig;

class HomeController
{
    private UserService $userService;
    private ChatService $chatService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        echo 'Tesere';
        if ($this->isLoggedIn()) {
            // Ako je prijavljen, prikaži Home stranicu
            $this->showHomePage();
        } else {
            // Ako nije prijavljen, preusmeri na Login stranicu
            $this->redirectToLogin();
        }


    }

    private function showHomePage()
    {
        $users  = $this->userService->index();
        //$chats = $
        $this->documentManager->loadComponent('home', ['users' => $users]);
    }

    private function redirectToLogin()
    {
        header('Location: ' . DomainConfig::$BASE_PATH . '/user/login');
        exit;
    }

    private function isLoggedIn(): bool
    {
        // Provera sesije ili tokena za prijavljenog korisnika
        return isset($_SESSION['user_id']);
    }
}