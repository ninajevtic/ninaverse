<?php

class Router2
{
    protected $routes = [];


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
    //echo '404 Not Found';
    //requre views/{$code}.php
    //require views/404.php;
    //ubija dalje izvrsavanje
    //die();
}
}
//
//$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
////                echo $uri;
////                if($uri == '/') {
////                }elseif ($uri == '/login') {
////
////                }
////                elseif ($uri == '/register') {
////
////                }
////                elseif ($uri == '/logout') {
////
////                }
////                else { }
//$routes = [
//    '/'         => 'controllers/home.php',
//    '/register' => 'Register',
//    '/login'    => 'Login',
//    '/logout'   => 'Logout',
//];
//function routeToControll($uri, $routes)
//{
//    if (array_key_exists($uri, $routes)) {
//        //require $routes[$uri];
//    } else {
//        abort();
//        //abort(404);
//    }
//}
//
//function abort($code = 404)
//{
//    //http_response_code(404);
//    http_response_code($code);
//    //echo '404 Not Found';
//    //requre views/{$code}.php
//    //require views/404.php;
//    //ubija dalje izvrsavanje
//    //die();
//}
//
//routeToControll($uri, $routes);
//ZA WEB.PHP
//$router->get('/', 'controllers/index.php');
//$router->delete('/message', 'controllers/message/destroy.php');
//INDEX.PHP
//use core router2;
//$router = new Router2();
//dolazak do web.php
//$routers = require base_path('routes.php');
//$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
//$router->dispatch();
//tj.
//$method =  if(isset($_POST['_method'])) ? $_POST['method'] : $_SERVER['REQUEST_METHOD'];
//$method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
//$route->route($uri, $method);