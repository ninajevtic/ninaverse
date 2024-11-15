<?php

use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
require __DIR__ . '/routes/web.php';
$router->route();




