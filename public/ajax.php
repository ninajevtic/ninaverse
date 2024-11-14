<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;

// Uključite autoload za sve zavisnosti
require_once __DIR__ . '/../vendor/autoload.php';
// Pokrenite sesiju
session_start();
// Proverite da li je zahtev AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'
) {
    http_response_code(403);
    echo json_encode(['error' => 'Access forbidden']);
    exit;
}

// Konfiguracija baze podataka, može biti deo singletona kao u prethodnim primerima
use App\Services\UserService;

header(
    'Content-Type: application/json'
); // Postavite da odgovor bude u JSON formatu

// Provera HTTP metode
$method = $_SERVER['REQUEST_METHOD'];

// Preuzmite podatke iz različitih metoda
$inputData = [];
if ($method === 'POST') {
    $inputData = $_POST;
} elseif ($method === 'GET') {
    $inputData = $_GET;
} else {
    // Za PUT i DELETE i druge metode
    parse_str(file_get_contents("php://input"), $inputData);
}

// Podesite parametre, npr. tip akcije koja se traži
// Podesite parametre, npr. tip akcije koja se traži
$action = $inputData['action'] ?? null;
$module = $inputData['module'] ?? null;
if (!$action || !$module) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}
try {
    switch ($module) {
        case 'user':
            $controller = new UserController();
            break;
        case 'auth':
            $controller = new AuthController();
            break;
        // Dodajte još modula prema potrebi
        default:
            throw new Exception('Unknown module');
    }
    // Proverite da li metoda postoji u kontroleru
    if (method_exists($controller, $action)) {
        // Prosleđivanje podataka i obrade prema HTTP metodi
        $response = match ($method) {
            'GET' => $controller->$action($inputData),
            'POST' => $controller->$action($inputData),
            'PUT' => $controller->$action($inputData),
            'DELETE' => $controller->$action($inputData),
            default => throw new Exception("Unsupported HTTP method")
        };
        echo json_encode(['status' => 'success', 'data' => $response]);
    } else {
        throw new Exception("Action '$action' not found");
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

//try {
//    $userService = new UserService();
//    switch ($action) {
//        case 'createUser':
//            $name = $_POST['name'] ?? '';
//            $email = $_POST['email'] ?? '';
//            $password = $_POST['password'] ?? '';
//            if (!$name || !$email || !$password) {
//                throw new Exception('All fields are required.');
//            }
//            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//            $userService->createUser([
//                'name'          => $name,
//                'email'         => $email,
//                'password_hash' => $hashedPassword
//            ]);
//            echo json_encode(
//                [
//                    'status'  => 'success',
//                    'message' => 'User created successfully'
//                ]
//            );
//            break;
//        case 'getUser':
//            $userId = (int)($_POST['user_id'] ?? 0);
//            if ($userId <= 0) {
//                throw new Exception('Invalid user ID.');
//            }
//            $user = $userService->findUserById($userId);
//            if (!$user) {
//                throw new Exception('User not found.');
//            }
//            echo json_encode(['status' => 'success', 'user' => $user]);
//            break;
//        default:
//            throw new Exception('Invalid action specified.');
//    }
//} catch (Exception $e) {
//    http_response_code(400);
//    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
//}

