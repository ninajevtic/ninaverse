<?php

namespace App\Views\Modules;

use App\Views\Theme; // Dodajte ovo da biste uvezli klasu Theme

class LoginTheme extends Theme
{
    public function __construct(string $name, array $dependencies = [])
    {
        parent::__construct($name, $dependencies);
    }

    public function process(): void
    {
        if ($this->isProcessed) {
            return;
        }

        $this->positions = [
            'header' => '<h1>Welcome to the Login Page</h1>',
            'main'   => '',
            'footer' => '<footer>Footer content here</footer>',
        ];

        $this->isProcessed = true;
    }
    public function render(): string
    {
        return <<<HTML
        <html>
        <head><title>Login Page</title></head>
        <body>
            <header>{$this->positions['header']}</header>
            <main>{$this->positions['main']}</main>
            <footer>{$this->positions['footer']}</footer>
        </body>
        </html>
        HTML;
    }
}