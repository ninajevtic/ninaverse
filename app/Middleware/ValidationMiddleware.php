<?php
namespace App\Middleware;

class ValidationMiddleware {
    private $requiredFields;

    // Konstruktor prima listu obaveznih polja za validaciju
    public function __construct(array $requiredFields) {
        $this->requiredFields = $requiredFields;
    }

    public function handle($params) {
        foreach ($this->requiredFields as $field) {
            if (empty($_POST[$field])) {
                http_response_code(400);
                echo "Error: Missing or invalid field - $field";
                return false;  // Zaustavi dalje izvršenje ako validacija nije prošla
            }
        }
        return true;  // Nastavi sa izvršenjem rute ako su sva polja validna
    }
}
