<?php
use Core\Router;

// Pokretanje sesije
session_start();
// Prilikom otvaranja forme (npr. na početku stranice za prijavu)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];


require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
require __DIR__ . '/routes/web.php';
$router->route();




