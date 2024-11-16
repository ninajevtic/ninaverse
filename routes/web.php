<?php

use App\Controllers\AuthController;
const BASE_PATH = '/ninaverse';

$router->addRoute('GET', BASE_PATH . '/', AuthController::class, 'test');

