<?php

namespace App\Middleware;

use App\Utils\Logger;

class LoggingMiddleware
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(
        );  // Možeš proslediti i prilagođenu putanju do fajla
    }

    public function handle($params)
    {
        $this->logger->info('Request received', [
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'url'        => $_SERVER['REQUEST_URI'],
            'method'     => $_SERVER['REQUEST_METHOD'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        return true;  // Nastavi sa izvršenjem rute
    }
}