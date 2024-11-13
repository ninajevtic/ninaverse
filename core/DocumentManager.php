<?php

namespace Core;

class DocumentManager
{
    private $basePath;

    public function __construct($basePath = '')
    {
        $this->basePath = $basePath;
    }

    public function generateUrl($path)
    {
        // Generiši potpuni URL sa baznom putanjom
        return $this->basePath . '/' . trim($path, '/');
    }

    public function loadComponent($component, $data = [])
    {
        // Osiguraj se da `$documentManager` bude u nizu podataka
        $data['documentManager'] = $this;  // Dodaj `$this` kao `$documentManager`
        // Učitaj odgovarajući template za dati komponent
        $templatePath = __DIR__ . '/../views/' . $component . '.php';
        if (file_exists($templatePath)) {
            extract($data);
            // Prikupi sadržaj komponenta u promenljivu
            ob_start();
            include $templatePath;
            $content = ob_get_clean();

//            // Dodaj dijagnostički ispis
//            echo "<!-- DEBUG: Content Loaded: -->";
//            echo "<!-- " . htmlspecialchars($content) . " -->";

            // Učitaj layout i umetni sadržaj
            include __DIR__ . '/../views/layout.php';
        } else {
            echo "Template not found: " . $templatePath;
        }
    }
}

