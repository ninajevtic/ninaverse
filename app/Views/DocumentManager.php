<?php

namespace App\Views;

use App\Views\Modules\LoginTheme;
use App\Views\Modules\LoginFormModule;

class DocumentManager
{
    private $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    /**
     * Renderuje stranicu za login
     *
     * @param object|null $user - Podaci o korisniku (ako su potrebni)
     * @return string - Generisani HTML
     */
    public function renderLoginPage($user = null): string
    {
        // 1. Kreiraj instancu LoginTheme
        $theme = new LoginTheme("LoginTheme");

        // 2. Procesiraj theme
        $theme->process();

        // 3. Kreiraj instancu LoginFormModule
        $loginFormModule = new LoginFormModule("LoginForm");

        // 4. Procesiraj formu
        $loginFormModule->process();

        // 5. Dodeli renderovani HTML poziciji "main"
        $theme->setPositionValue("main", $loginFormModule->render());

        // 6. Registruj komponente
        $this->engine->registerComponent($theme);
        $this->engine->registerComponent($loginFormModule);

        // 7. Generiši HTML
        return $this->engine->generate($theme);
    }
}