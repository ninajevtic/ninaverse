<?php

namespace Core;

use Config\RouteConfig;
use Config\DomainConfig;
use http\Exception;

class Router
{
    public array $routeConfig;
    private array $segments = [];

    public function __construct()
    {
        $this->routeConfig = RouteConfig::ROUTES['components'];
        $this->validateUrl();
        $this->parseLink();
        $this->validateLink();
    }

    private function validateUrl()
    {
        // Proveri da li URL sadrži znak "?" (query string) url mora da sadrzi samo slova, brojeve, - / .
        if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
            $this->redirectToError();
        }

        //url mora da sadrzi samo slova, brojeve, - / .
        if (!preg_match('/^[a-zA-Z0-9\/.\-]+$/', $_SERVER['REQUEST_URI'])) {
            $this->redirectToError();
        }
    }

    private function parseLink()
    {
        // Uklonite baznu putanju (ako postoji) subfolder zbog dev i local host.
        $link = substr(
            $_SERVER['REQUEST_URI'],
            strlen(DomainConfig::BASE_PATH)
        );
        //izdvojiti komponentu, metodu i parametre iz url u 1 niz
        $this->segments = explode(
            '/',
            $link
        );
    }

    private function validateLink()
    {
        if (empty($this->segments)) {
            $this->redirectToError();
        }

        $componentName = $this->segments[0];
        $methodName = $this->segments[1] ?? null;
        $actualParam = $this->segments[2] ?? null;

        try {
            $this->validateRoute($componentName, $methodName, $actualParam);
            $this->dispatch(implode('/', array_filter($this->segments)), 200);
        } catch (\Exception $e) {
            $this->redirectToError();
        }
    }

    private function validateRoute(string $componentName, ?string $methodName, ?string $actualParam): void
    {
        $this->validateComponent($componentName);

        if ($methodName) {
            $this->validateMethod($componentName, $methodName);
        }

        if ($actualParam) {
            $this->validateParam($componentName, $methodName, $actualParam);
        }

    }

    private function validateComponent(string $componentName): void
    {
        // Ako je index, preusmeri na home.
        if ($componentName === "") {
            $componentName = 'home';
            $this->segments[0] = $componentName;
        }
        if (!isset($this->routeConfig[$componentName]) || !$this->routeConfig[$componentName]['enabled']) {
            throw new \Exception("Component $componentName not found or disabled");
        }
    }

    private function validateMethod(string $componentName, string $methodName)
    {
        $methodConfig
            = $this->routeConfig[$componentName]['method'][$methodName] ?? null;
        if (!$methodConfig || !$methodConfig['enabled']) {
            throw new \Exception("Method $methodName not found or disabled");
        }
    }

    private function validateParam(
        string $componentName,
        string $methodName,
        string $actualParam
    ) {
        // Proveri parametre ako postoje.
        $expectedParam
            = $this->routeConfig[$componentName]['method'][$methodName]['param'] ?? null;
        // Validacija parametra: tačno 10 karaktera, samo slova i brojevi.
        if (!$expectedParam || !preg_match('/^[a-zA-Z0-9]{10}$/', $actualParam)) {
            throw new \Exception("Invalid parameter $actualParam");
        }
    }

    private function redirectToError(int $code = 404): void
    {
        $this->dispatch('error', $code);
    }

    private function dispatch(string $route, int $code): void
    {
        var_dump($route);
        http_response_code($code);
        header('Location: ' . DomainConfig::BASE_PATH . $route);
//        exit;
        //?????
        //OVDE POZIV ZA DocumentManager?
        //$this->documentManager($component, $method, $param, $code)
        exit;
    }
}