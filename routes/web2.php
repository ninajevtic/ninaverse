<?php

use App\Middleware\Authenticate;
use App\Middleware\LoggingMiddleware;
use App\Middleware\ValidationMiddleware;
//use Core\Router;

global $documentManager, $router;
// 3. Kreiraj instancu routera i pokreni rute
//$router = new Router();

//$router->get('/', 'controllers/index.php');
//$router->delete('/message', 'controllers/message/destroy.php');

$router->get('/', function() use ($documentManager) {
    //$documentManager->loadComponent('login', ['csrfToken' => $_SESSION['csrf_token']]);
    $documentManager->loadComponent('login');
});

////$router->post('/login', 'AuthController@login');
$router->get('/login', function() use ($documentManager) {
    $documentManager->loadComponent('login', ['csrfToken' => $_SESSION['csrf_token']]);
});
$router->post('/login', 'AuthController@handleLoginRequest');
//$router->get('/logout', 'AuthController@logout');

//// Registracija middleware-a za validaciju specifičnih polja
//// Na primer, za POST zahtev koji očekuje `username` i `email` parametre
//$router->post('/register', 'AuthController@register', [
//    LoggingMiddleware::class,
//    new ValidationMiddleware(['username', 'email'])
//    // Prosleđujemo obavezna polja
//]);
//
//$router->post('/user/register', 'UserController@register');
//$router->post('/user/login', 'UserController@login');
//
//$router->get('/chat/{chat_id}', 'ChatController@show');
//$router->post('/chat', 'ChatController@create');
//// Dodavanje rute sa middleware-om
//$router->get('/dashboard', 'DashboardController@index', [Authenticate::class]);
//// Registracija middleware-a za logovanje (primenjuje se na sve rute)
//$router->get(
//    '/dashboard',
//    'DashboardController@index',
//    [LoggingMiddleware::class]
//);
//// Ruta bez middleware-a
//$router->get(
//    '/profile',
//    'ProfileController@index',
//    [\App\Middleware\Authenticate::class]
//);
