<?php
namespace App\Controllers;

class AuthController {

    // Metoda za obradu login zahteva sa CSRF proverom
    public function handleLoginRequest() {
        var_dump("tes");
        // Provera CSRF tokena
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            echo "Invalid CSRF token";
            exit;
        }

        // Poziv login metode sa podacima iz POST zahteva
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Na ovom mestu ide logika provere korisnika, npr. provera lozinke itd.
        // Za primer, samo ispisujemo poruku da je prijava uspešna
        echo "Login successful for email: " . htmlspecialchars($email);
        //$this->login($email, $password);
    }
    public function register($email, $password, $name) {
        // Hashovanje lozinke
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Sačuvaj korisnika u bazi (pretpostavljamo da koristiš neki UserModel)
        UserModel::create([
            'email' => $email,
            'password_hash' => $passwordHash,
            'name' => $name
        ]);
    }
    // Prijava korisnika
    public function login($email, $password) {
        // Pretpostavka: Pretražuješ korisnika u bazi po email-u
        $user = $this->findUserByEmail($email);

        // Verifikacija lozinke pomoću password_verify
        if ($user && password_verify($password, $user->getPasswordHash())) {
            $_SESSION['user'] = [
                'id' => $user->getUserId(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
            ];
            header('Location: /dashboard');  // Preusmeravanje nakon uspešne prijave
            exit;
        } else {
            echo "Invalid email or password";
        }
    }

    // Odjava korisnika
    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /login');  // Preusmeravanje nakon odjave
        exit;
    }

    // Pomoćna funkcija za pretragu korisnika u bazi
    private function findUserByEmail($email) {
        // Pretpostavka: koristiš model za pretragu korisnika po email-u
        return UserModel::findByEmail($email);
    }
}
