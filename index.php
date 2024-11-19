<?php
use Core\Router;
use Core\Session;

////require_once __DIR__ . '/core/Session.php';
var_dump(class_exists('Core\Session'));
//
//if (class_exists('Core\Session')) {
//    echo "Class 'Core\\Session' loaded successfully.";
//} else {
//    echo "Class 'Core\\Session' not found.";
//}
//// Pokrenite sesiju
Session::start();
//
//// Generišite ili dohvatite CSRF token
$csrfToken = Session::getCsrfToken();

//// Pokretanje sesije
//session_start();
//// Prilikom otvaranja forme (npr. na početku stranice za prijavu)
//if (empty($_SESSION['csrf_token'])) {
//    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
//}
//$csrfToken = $_SESSION['csrf_token'];


require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
require __DIR__ . '/routes/web.php';
$router->route();




