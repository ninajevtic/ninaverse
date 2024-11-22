<?php
namespace App\Views\Modules;

use App\Views\Module;
use Core\Validator;
use Exception;
use App\Views\Form;
use App\Models\User;

class LoginFormModule extends Module
{
    private Form $form;

    public function __construct(string $name, array $dependencies = [])
    {
        parent::__construct($name, $dependencies);

        // Konfiguracija forme sa pravilima validacije
        $formConfig = [
            'username' => [
                'label' => 'Username',
                'inputType' => 'text',
//                'rules' => [
//                    'string' => ['min' => 5, 'max' => 50],
//                    'required' => true,
//                ],
                'rules' => User::$rules['name'], // Koristi pravila iz User modela
            ],
            'password' => [
                'label' => 'Password',
                'inputType' => 'password',
                'rules' => [
                    'string' => ['min' => 8, 'max' => 100],
                    'required' => true,
                ],
            ],
        ];

        $this->form = new Form('/login', 'POST', $formConfig);
    }

    public function process(): void
    {
        // Provera CSRF tokena (opcionalno)
        $this->values = [
            'csrf_token' => $_SESSION['csrf_token'] ?? 'missing_token',
        ];

        // Validacija forme na POST zahtev
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = $this->form->validate($_POST);

            if ($isValid) {
                try {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Proveravamo korisničko ime koristeći User model
                    $user = new User();
                    $user->setName($username);

                    // Dalja obrada login podataka
                    echo "Login successful for user: $username";
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Form contains errors.";
            }
        }
    }

    public function render(): string
    {
        // Dodavanje CSRF tokena u formu
        $csrfField = "<input type=\"hidden\" name=\"csrf_token\" value=\"{$this->values['csrf_token']}\">";

        // Renderovanje forme
        return $csrfField . $this->form->render();
    }
}

//namespace App\Views\Modules;
//
//use App\Views\Module;
//
//class LoginFormModule extends Module
//{
//    public function __construct(string $name, array $dependencies = [])
//    {
//        parent::__construct($name, $dependencies);
//    }
//    public function process(): void
//    {
//        // Dodaj potrebne vrednosti za login formu
//        $this->values = [
//            'csrf_token' => $_SESSION['csrf_token'] ?? 'missing_token',
//            'action_url' => '/login',
//        ];
//    }
//
//    public function render(): string
//    {
//        // Renderuj šablon forme za login
//        return <<<HTML
//    <form action="{$this->values['action_url']}" method="POST">
//        <input type="hidden" name="csrf_token" value="{$this->values['csrf_token']}">
//        <label for="username">Username:</label>
//        <input type="text" id="username" name="username">
//        <label for="password">Password:</label>
//        <input type="password" id="password" name="password">
//        <button type="submit">Login</button>
//    </form>
//    HTML;
//
//    }
//}