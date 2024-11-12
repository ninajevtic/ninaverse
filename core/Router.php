<?php

class Router
{
    private $routes = [];
    private $middlewares = [];

    public function get($route, $action, $middlewares = []) {
        $this->registerRoute('GET', $route, $action, $middlewares);
    }

    public function post($route, $action, $middlewares = []) {
        $this->registerRoute('POST', $route, $action, $middlewares);
    }

    private function registerRoute($method, $route, $action, $middlewares) {
        $route = $this->parseRoute($route);
        $this->routes[$method][$route] = ['action' => $action, 'middlewares' => $middlewares];
    }

    private function parseRoute($route) {
        return '#^' . preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $route) . '$#';
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->parseUrl();

        foreach ($this->routes[$method] as $route => $details) {
            if (preg_match($route, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Pokretanje middleware-a
                foreach ($details['middlewares'] as $middleware) {
                    $middlewareInstance = new $middleware();
                    if (!$middlewareInstance->handle($params)) {
                        return;  // Ako middleware zaustavi izvršenje, prekida se dispatch
                    }
                }

                // Pozivanje akcije
                $action = $details['action'];
                if (is_callable($action)) {
                    call_user_func_array($action, $params);
                } else if (is_string($action)) {
                    list($controller, $method) = explode('@', $action);
                    (new $controller)->$method(...array_values($params));
                }
                return;
            }
        }

        http_response_code(404);
        echo "404 - Route not found";
    }

    private function parseUrl() {
        $uri = $_SERVER['REQUEST_URI'];
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }
}