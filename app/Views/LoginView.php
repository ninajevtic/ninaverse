<?php

namespace App\Views;

class LoginView
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function render($message = '')
    {
        // Kreiranje modula za formu
        $formModule = new Module("
            <form method='post' action='/login'>
                <label>Username:</label>
                <input type='text' name='username'>
                <label>Password:</label>
                <input type='password' name='password'>
                <button type='submit'>Login</button>
            </form>
            <p>{{message}}</p>
        ");

        // Dodavanje poruke
        $formModule->addToPosition('message', $message);

        // Dodavanje modula u temu
        $this->theme->addToPosition('content', $formModule);

        // Renderovanje krajnjeg izlaza
        echo $this->theme->render();
    }
}
