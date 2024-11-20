<?php
namespace Core;

use Core\routes\Router;

class App
{
    public static function main() : void
    {
        Session::start();
        $csrfToken = Session::getCsrfToken();

        $router = new Router();
        $router->loadRoutes(__DIR__ . '/routes/web.php');
        $router->dispatch();


    }
}

