<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Services\ChatService;
use App\Views\LoginView;
use App\Views\Theme;
use App\Modules\LoginTheme;
use App\Views\Module;
use App\Views\Plugin;
use App\Views\Renderer;

use App\Views\TemplateEngine;
//use App\Views\DocumentManager;
//use Core\DocumentManager;

class UserController
{
    private $renderer;
    private UserService $userService;
    private ChatService $chatService;
    private TemplateEngine $engine;
    //protected LoginView $loginView;

    private DocumentManager $documentManager;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->chatService = new ChatService();
        $this->engine = new TemplateEngine();
        //$this->renderer = new Renderer();
        //$this->documentManager = new DocumentManager();
        //$this->documentManager = new DocumentManager(new TemplateEngine());
        //$this->loginView = new LoginView();
    }

    public function index()
    {
        $users = $this->userService->index();
        // Prikazati korisnike u pogledu ili vratiti kao JSON
        $this->documentManager->loadComponent('user');
        return ['status' => 'success', 'message' => 'User updated successfully'];
    }

    public function show(int $id)
    {
        $user = $this->userService->show($id);
        // Prikazati korisnika ili vratiti kao JSON
    }

    public function store()
    {
        $data = $_POST; // Ili koristiti Request objekat
        $newUserId = $this->userService->store($data);
        // Preusmeriti ili vratiti odgovor
    }

    public function update(int $id)
    {
        $data = $_POST; // Ili koristiti Request objekat
        $this->userService->update($id, $data);
        // Preusmeriti ili vratiti odgovor
        // Obrada za PUT (ažuriranje korisnika)
        // Implementirajte logiku ažuriranja

        return ['status' => 'success', 'message' => 'User updated successfully'];
    }

    public function destroy(int $id)
    {
        $this->userService->destroy($id);
        // Preusmeriti ili vratiti odgovor
    }


    public function login()
    {

        // 1. Kreiraj instancu LoginTheme
        $theme = new \App\Views\Modules\LoginTheme("LoginTheme");

        // 2. Pozovi process da inicijalizuje pozicije
        $theme->process();
        //echo '<pre>Positions in LoginTheme after process:</pre>';
        //print_r($theme->getPositions());

        // 3. Kreiraj LoginFormModule
        $loginFormModule = new \App\Views\Modules\LoginFormModule("LoginForm");

        // 4. Procesiraj formu
        $loginFormModule->process();

        // 5. Dodeli renderovani HTML poziciji "main"
        $theme->setPositionValue("main", $loginFormModule->render());

        // 6. Registruj komponente i generiši HTML
        $this->engine->registerComponent($theme);
        $this->engine->registerComponent($loginFormModule);

        echo $this->engine->generate($theme);
        //$this->documentManager->loadComponent('login', ['csrfToken' => $_SESSION['csrf_token']]);

    }
    public function action(array $data)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'POST':
                return $this->create($data);
            case 'GET':
                return $this->get($data);
            case 'PUT':
                return $this->update($data);
            case 'DELETE':
                return $this->delete($data);
            default:
                throw new \Exception("Unsupported HTTP method");
        }
    }
    public function create(array $data) {
        // Validacija podataka
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
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

        if (!$name || !$email || !$password) {
            //throw new \Exception('Name, email and password are required');
            return json_encode([
                'status' => 'error',
                'message' => 'Name, email, and password are required'
            ]);
        }

        // Hash lozinke
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Kreiranje korisnika pomoću servisa
        //return $this->userService->createUser($name, $email);
        try{
            //$this->userService->createUser($name, $email, $hashedPassword);
            $this->userService->createUser([
                'name' => $name,
                'email' => $email,
                'password_hash' => $hashedPassword
            ]);
            return json_encode([
                'status' => 'success',
                'message' => 'User created successfully'
            ]);
        }
        catch (\Exception $e) {
            http_response_code(400);
            //return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    //samo admin
    public function delete($data) {
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            throw new \Exception('User ID is required');
        }

        $this->userService->deleteUser($userId);
        return ['status' => 'success', 'message' => 'User deleted successfully'];

    }

    public function showUser(int $userId)
    {
        $user = $this->userService->findUserById($userId);
        // Prikazivanje korisnika ili vraćanje kao odgovor
//        $userId = (int)($_POST['user_id'] ?? 0);
////            if ($userId <= 0) {
////                throw new Exception('Invalid user ID.');
////            }
////            $user = $userService->findUserById($userId);
////            if (!$user) {
////                throw new Exception('User not found.');
////            }
////            echo json_encode(['status' => 'success', 'user' => $user]);
    }

    private function get(array $data)
    {
        // Obrada za GET (dohvatanje korisnika)
        $userId = $data['user_id'] ?? null;
        if (!$userId) {
            throw new \Exception("User ID is required.");
        }

        // Dohvatite korisnika iz baze
        // (Ovde ide vaša logika za dohvatanje korisnika)

        return ['status' => 'success', 'data' => 'User data here'];
    }

//    private function update(array $data)
//    {
//        // Obrada za PUT (ažuriranje korisnika)
//        // Implementirajte logiku ažuriranja
//
//        return ['status' => 'success', 'message' => 'User updated successfully'];
//    }

    public function createChatForUser(int $userId, array $chatData)
    {
        $chatData['created_by'] = $userId;
        $this->chatService->createChat($chatData);
        // Kreirajte chat i vratite rezultat
    }

    //veza sa DocumentManager todo
    // Unutar kontrolera:
    public function renderUserList() {
        ob_start();
        include __DIR__ . '/../views/user_list.php'; // Pretpostavimo da user_list.php generiše HTML za prikaz korisnika
        $html = ob_get_clean();
        return $html;
    }
}