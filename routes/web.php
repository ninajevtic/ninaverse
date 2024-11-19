<?php

use App\Controllers\AuthController;
use App\Controllers\ChatController;
const BASE_PATH = '/ninaverse';
//ne radi
//const BASE_PATH = 'http://localhost/ninaverse';

$router->addRoute('GET', BASE_PATH . '/', AuthController::class, 'test');
//$router->addRoute('GET', '/', AuthController::class, 'test');
$router->addRoute('GET', BASE_PATH .'/chat', ChatController::class, 'index');
$router->addRoute('POST', '/chat/load-more', ChatController::class, 'loadMoreConversations');

