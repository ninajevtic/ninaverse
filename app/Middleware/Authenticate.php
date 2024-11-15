<?php

namespace App\Middleware;

class Authenticate
{
    public function handle($params)
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo "Unauthorized";
            return false;
        }
        return true;
    }
}
