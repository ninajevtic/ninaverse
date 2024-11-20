<?php

use App\Controllers\AuthController;
use App\Controllers\ChatController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use Config\DomainConfig;

$router->register('GET', DomainConfig::$BASE_PATH . '/', HomeController::class, 'index');
$router->register('GET', DomainConfig::$BASE_PATH .'/user/login', UserController::class, 'login');
//$router->register('GET', '/', AuthController::class, 'test');
$router->register('GET', DomainConfig::$BASE_PATH .'/chat', ChatController::class, 'index');
//$router->register('POST', '/chat/load-more', ChatController::class, 'loadMoreConversations');


