<?php

namespace archive;

use App\Exceptions\RouteNotFoundException;

use function Core\base_path;

class Router2
{
    //public const BASE_PATH;
    private $routes = [];
    private $middlewares = [];

    public function register(string $route, callable $action): self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri)
    {
        $route = explode('?', $requestUri)[0];
        var_dump($this->routes); // Debug registered routes
        var_dump($route);       // Debug resolved route

        $action = $this->routes[$route] ?? null;

        if(!$action) {
            throw new RouteNotFoundException();
        }

        return call_user_func($action);
    }

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

    public function route($uri,$method){
        foreach ($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                return require base_path($route['controller']);
            }
        }

        $this->abort();

    }

    protected function abort($code = 404)
    {
        //http_response_code(404);
        http_response_code($code);
        //requre views/{$code}.php
        //require views/404.php;
        //ubija dalje izvrsavanje
        die();
    }

//    public function get($route, $action, $middlewares = [])
//    {
//        $this->registerRoute('GET', $route, $action, $middlewares);
//    }
//
//    public function post($route, $action, $middlewares = [])
//    {
//        $this->registerRoute('POST', $route, $action, $middlewares);
//    }

    /**
     * @param string $method
     * @param string $route
     * @param string $action
     * @param mixed  $middlewares
     *
     * @return void
     */
    //private function registerRoute(string $method, string $route, string $action, mixed $middlewares): void
    private function registerRoute($method, $route, $action, $middlewares): void
    {
        $route = $this->parseRoute($route);
        $this->routes[$method][$route] = [
            'action'      => $action,
            'middlewares' => $middlewares
        ];
    }

    private function parseRoute($route)
    {
        return '#^' . preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $route)
            . '$#';
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->parseUrl();
//        // Dodaj ispis za dijagnostiku
//        echo "Request Method: $method<br>";
//        echo "Parsed URI: $uri<br>";
//        echo "Defined Routes: ";
//        print_r($this->routes[$method]);
//        echo "<br>";
        foreach ($this->routes[$method] as $route => $details) {
//            // Dodaj dijagnostiku za `preg_match`
//            if (preg_match($route, $uri, $matches)) {
//                echo "Match found for route: $route<br>";
//
//                $params = array_filter(
//                    $matches,
//                    'is_string',
//                    ARRAY_FILTER_USE_KEY
//                );
//
//                $action = $details['action'];
//                if (is_callable($action)) {
//                    call_user_func_array($action, $params);
//                } else if (is_string($action)) {
//                    list($controller, $method) = explode('@', $action);
//                    (new $controller)->$method(...array_values($params));
//                }
//                return;
//            } else {
//                echo "No match for route: $route with URI: $uri<br>";
//            }
            if (preg_match($route, $uri, $matches)) {
                $params = array_filter(
                    $matches,
                    'is_string',
                    ARRAY_FILTER_USE_KEY
                );
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
                } else {
                    if (is_string($action)) {
                        list($controller, $method) = explode('@', $action);
                        $controller = "App\\Controllers\\$controller";
                        (new $controller)->$method(...array_values($params));
                    }
                }
                return;
            }
        }
        http_response_code(404);
        echo "404 - Route not found";
    }

    private function parseUrl(): string
    {
//        $uri = $_SERVER['REQUEST_URI'];
//        //echo $uri;
//        // Ukloni poddirektorijum i `index.php` ako su prisutni
//        //$uri = str_replace(['/ninaverse/public', '/index.php'], '', $uri);
//        // Uklonite dodatni put (npr. '/test/public') ako se aplikacija nalazi u poddirektorijumu
//        $uri = str_replace(
//            '/ninaverse/public',
//            '',
//            $uri
//        ); // Podesite ovo prema putanji vašeg projekta
//        // Uklonite `index.php` iz URI-a
//        $uri = str_replace(
//            '/index.php',
//            '',
//            $uri
//        );  // Ukloni index.php ako je prisutan
//        // Trimuj dodatne `/` sa početka i kraja URI-ja
//        $trimmedUri = trim(parse_url($uri, PHP_URL_PATH), '/');
//        // Vrati "/" ako je URI prazan nakon trimovanja
//        return $trimmedUri === '' ? '/' : $trimmedUri;
        $uri = $_SERVER['REQUEST_URI'];
        // Ukloni poddirektorijum (`/ninaverse/public`) ako se aplikacija nalazi u njemu
        if (strpos($uri, '/ninaverse') === 0) {
            $uri = substr($uri, strlen('/ninaverse'));
        }
        // Ukloni `index.php` iz URI-a, ako je prisutan
        $uri = str_replace('/index.php', '', $uri);
        // Trimuj dodatne `/` sa početka i kraja URI-ja
        $trimmedUri = trim(parse_url($uri, PHP_URL_PATH), '/');
        // Dodaj ispis za dijagnostiku
        // Vrati "/" ako je URI prazan nakon trimovanja
        //return $trimmedUri === '' ? '/' : $trimmedUri;
        // Dodaj početni `/` za kompatibilnost sa definisanim rutama
        return '/' . $trimmedUri;
    }
}