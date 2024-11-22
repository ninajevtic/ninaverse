<?php

namespace Config;

use Config\DomainConfig;

class ControlConfig
{
// Namespace kontrolera
    // Namespace kontrolera
    private static string $controllerNamespace;

    // Putanja do direktorijuma sa kontrolerima
    private static string $controllerPath;

    /**
     * Postavi osnovne vrednosti na osnovu `DomainConfig`.
     */
    public static function initialize(): void
    {
        self::$controllerNamespace = 'App\\Controllers';
        self::$controllerPath = __DIR__. '/../App/Controllers'; // Obrati pažnju na '/' umesto '\'
    }

    /**
     * Automatsko generisanje liste kontrolera na osnovu klasa u direktorijumu.
     *
     * @return array
     */
    public static function getControllers(): array
    {
        $files = scandir(self::$controllerPath);
        $controllers = [];

        foreach ($files as $file) {
            if (str_ends_with($file, 'Controller.php')) {
                $className = self::$controllerNamespace  . '\\' . pathinfo($file, PATHINFO_FILENAME);
                if (class_exists($className)) {
                    // Izdvajanje osnovnog imena kontrolera (bez "Controller" sufiksa)
                    $controllers[] = strtolower(str_replace('Controller', '', pathinfo($file, PATHINFO_FILENAME)));
                }
            }
        }

        return $controllers;
    }
}