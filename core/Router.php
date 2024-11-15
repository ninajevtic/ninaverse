<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => 'GET'
        ];
    }

    public function post($uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => 'POST'
        ];
    }

    public function delete($uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => 'DELETE'
        ];
    }

    public function patch($uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => 'PATCH'
        ];
    }

    public function put($uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => 'PUT'
        ];
    }

    public function route()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                [$controller, $method] = explode('@', $route['controller']);
                $controller = "App\\Controllers\\$controller";

                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        return $controllerInstance->$method();
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
        //requre views/{$code}.php
        //require views/404.php;
        //ubija dalje izvrsavanje
        die();
    }
}