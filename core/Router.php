<?php

namespace Core;

class Router
{
    private $routes = [];
    private $middlewares = [];

    public function get($route, $action, $middlewares = [])
    {
        $this->registerRoute('GET', $route, $action, $middlewares);
    }

    public function post($route, $action, $middlewares = [])
    {
        $this->registerRoute('POST', $route, $action, $middlewares);
    }

    private function registerRoute($method, $route, $action, $middlewares)
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

        // Dodaj ispis za dijagnostiku
        echo "Request Method: $method<br>";
        echo "Parsed URI: $uri<br>";
        echo "Defined Routes: ";
        print_r($this->routes[$method]);
        echo "<br>";




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
        if (strpos($uri, '/ninaverse/public') === 0) {
            $uri = substr($uri, strlen('/ninaverse/public'));
        }

        // Ukloni `index.php` iz URI-a, ako je prisutan
        $uri = str_replace('/index.php', '', $uri);

        // Trimuj dodatne `/` sa početka i kraja URI-ja
        $trimmedUri = trim(parse_url($uri, PHP_URL_PATH), '/');

        // Dodaj ispis za dijagnostiku
        echo "Parsed URI (inside parseUrl): $trimmedUri<br>";
        // Vrati "/" ako je URI prazan nakon trimovanja
        //return $trimmedUri === '' ? '/' : $trimmedUri;
        // Dodaj početni `/` za kompatibilnost sa definisanim rutama
        return '/' . $trimmedUri;
    }
}