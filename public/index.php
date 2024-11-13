<?php
////preusmeravanje sa http na https
//if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//    $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//    header("Location: $redirect");
//    exit;
//}
use Core\DocumentManager;
use Core\Router;

// Pokretanje sesije
session_start();
// Prilikom otvaranja forme (npr. na početku stranice za prijavu)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];
// 1. Uključi Composer autoload (ako koristiš Composer za autoloading)
require_once __DIR__ . '/../vendor/autoload.php';
// Definišite baznu putanju
$basePath = '/ninaverse/public';
// Instancirajte DocumentManager
$documentManager = new DocumentManager($basePath);
// Proveri da li je korisnik na početnoj stranici
//if ($_SERVER['REQUEST_URI'] === '/ninaverse/public/index.php'
//    || $_SERVER['REQUEST_URI'] === '/ninaverse/public/'
//) {
//    // Učitaj login prikaz direktno
//    $documentManager->loadComponent('login', [
//        'csrfToken' => $csrfToken,
//        'documentManager' => $documentManager
//    ]);
//    exit;  // Završi dalje izvršavanje nakon učitavanja login stranice
//}
// Kreiraj instancu routera
$router = new Router();
// Uključi definicije ruta
//require_once __DIR__ . '/../routes/web.php';
// Pokreni router da obradi zahtev

// Funkcija koja uključuje `web.php` sa prosleđivanjem `$router` i `$documentManager`
function loadRoutes($router, $documentManager) {
    require __DIR__ . '/../routes/web.php';
}

// Pozovi funkciju sa `$router` i `$documentManager`
loadRoutes($router, $documentManager);
$router->dispatch();

