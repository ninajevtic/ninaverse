<?php

use App\Middleware\Authenticate;
use App\Middleware\LoggingMiddleware;
use App\Middleware\ValidationMiddleware;

// Koristi instancu routera za definisanje ruta
$router = new Router();
// Registracija middleware-a za logovanje (primenjuje se na sve rute)
$router->get(
    '/dashboard',
    'DashboardController@index',
    [LoggingMiddleware::class]
);
// Registracija middleware-a za validaciju specifičnih polja
// Na primer, za POST zahtev koji očekuje `username` i `email` parametre
$router->post('/register', 'AuthController@register', [
    LoggingMiddleware::class,
    new ValidationMiddleware(['username', 'email'])
    // Prosleđujemo obavezna polja
]);
$router->get('/', function () {
    echo "Welcome to the Chat App!";
});
$router->get('/chat/{chat_id}', 'ChatController@show');
$router->post('/chat', 'ChatController@create');
$router->get('/chat/{chat_id}', 'ChatController@show');
$router->post('/chat', 'ChatController@create');
$router->post('/user/register', 'UserController@register');
$router->post('/user/login', 'UserController@login');
// Dodavanje rute sa middleware-om
$router->get('/dashboard', 'DashboardController@index', [Authenticate::class]);
// Ruta bez middleware-a
$router->get('/login', 'AuthController@login');