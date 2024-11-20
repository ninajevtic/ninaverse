<?php

namespace Core\routes;

use Config\DomainConfig;
use Core\Validator;

class Router
{
    private $routes = [];

    /**
     * Učitavanje ruta iz fajla.
     *
     * @param string $filePath Putanja do fajla sa rutama.
     *
     * @return void
     * @throws \Exception Ako fajl sa rutama ne postoji.
     */
    public function loadRoutes(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Routes file not found: " . $filePath);
        }
        // Dostupnost $this unutar fajla
        $router = $this;
        // Uključivanje fajla sa rutama
        require $filePath;
    }

    public function register(
        string $method,
        string $uri,
        string $controllerClass,
        string $action
    ): void {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controllerClass, // Store class name
            'action' => $action,
            'method' => strtoupper($method)
        ];
    }

    public function generateFullUrl(string $relativePath): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        // Generišite apsolutni URL
        return $protocol . '://' . $host . $relativePath;
    }

    public function dispatch()
    {
        // Validacija URI-ja
        $url = $this->generateFullUrl($_SERVER['REQUEST_URI']);
        if (!Validator::url($url)) {
            $this->abort(400); // Bad Request ako URL nije validan
        }
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri
                && $route['method'] === strtoupper(
                    $method
                )
            ) {
                $controllerClass = $route['controller'];
                $action = $route['action'];
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $action)) {
                        return $controllerInstance->$action();
                    } else {
                        $this->abort(500); // Method not found
                    }
                } else {
                    $this->abort(500); // Controller not found
                }
            }
        }
        $this->abort(404); // Route not found
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        //404.php;
        $viewPath = __DIR__ . "/views/errors/{$code}.php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Error {$code}";
        }
        //ubija dalje izvrsavanje
        die();
    }
}