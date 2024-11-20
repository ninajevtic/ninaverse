<?php

namespace App\Controllers;

class MessageController
{
    private MessageService $messageService;

    public function __construct()
    {
        $this->messageService = new MessageService();
    }
    public function index()
    {
        $users = $this->userService->index();
        // Prikazati korisnike u pogledu ili vratiti kao JSON
        $this->documentManager->loadComponent('message');
    }

    public function show(int $id)
    {
        $user = $this->userService->show($id);
        // Prikazati korisnika ili vratiti kao JSON
    }

    public function store()
    {
        $data = $_POST; // Ili koristiti Request objekat
        $newMessageId = $this->messageService->store($data);
        // Preusmeriti ili vratiti odgovor
    }

    public function update(int $id)
    {
        $data = $_POST; // Ili koristiti Request objekat
        $this->messageService->update($id, $data);
        // Preusmeriti ili vratiti odgovor
    }

    public function destroy(int $id)
    {
        $this->messageService->destroy($id);
        // Preusmeriti ili vratiti odgovor
    }
}