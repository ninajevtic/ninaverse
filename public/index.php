<?php
// 1. Uključi Composer autoload (ako koristiš Composer za autoloading)
require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../core/Router.php';
use Core\Router;

// 2. Uključi definicije ruta
require_once __DIR__ . '/../routes/web.php';

// 3. Kreiraj instancu routera i pokreni rute
$router = new Router();

// 4. Definiši rute unutar `web.php` fajla
// primer: $router->get('/chat/{chat_id}', 'ChatController@show');

// 5. Pokreni router kako bi obradio zahtev
$router->dispatch();