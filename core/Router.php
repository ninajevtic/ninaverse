<?php

namespace Core;

class Router
{
    private $routes = [];

    public function addRoute(string $method, string $uri, string $controllerClass, string $action): void
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controllerClass, // Store class name
            'action'     => $action,
            'method'     => strtoupper($method)
        ];
    }

    public function route()
    {
        // Validacija URI-ja
        if (!\Core\Validator::validateUrl($_SERVER['REQUEST_URI'])) {
            $this->abort(400); // Bad Request ako URL nije validan
        }
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
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