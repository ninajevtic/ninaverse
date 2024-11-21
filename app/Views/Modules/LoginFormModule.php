<?php

namespace App\Views\Modules;

use App\Views\Module;

class LoginFormModule extends Module
{
    public function __construct(string $name, array $dependencies = [])
    {
        parent::__construct($name, $dependencies);
    }
    public function process(): void
    {
        // Dodaj potrebne vrednosti za login formu
        $this->values = [
            'csrf_token' => $_SESSION['csrf_token'] ?? 'missing_token',
            'action_url' => '/login',
        ];
    }

    public function render(): string
    {
        // Renderuj šablon forme za login
        return <<<HTML
    <form action="{$this->values['action_url']}" method="POST">
        <input type="hidden" name="csrf_token" value="{$this->values['csrf_token']}">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <button type="submit">Login</button>
    </form>
    HTML;

    }
}