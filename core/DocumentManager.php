<?php

namespace Core;

class DocumentManager
{
    public function render(string $template, array $data = []): void
    {
        $templatePath = __DIR__ . "/../app/Views/{$template}.php";

        if (!file_exists($templatePath)) {
            throw new \Exception("Template not found: $templatePath");
        }

        // Ekstraktuje podatke za dostupnost u prikazu
        extract($data);
        $layoutPath = __DIR__ . '/../app/Views/layout.php';
        //if (file_exists($layoutPath)) {
        //include $layoutPath;
        //} else {
        include $templatePath; // Ako nema layout-a, samo prikazuje template
        //}
        //if (file_exists($templatePath)) {
        //extract($data);
        // Uključuje osnovni layout

        //include $templatePath;
//        } else {
//            echo "Template not found: {$templatePath}";
//        }
    }

    //private $basePath;

//    public function __construct($basePath = '')
//    {
//        $this->basePath = $basePath;
//    }

    private $basePath = '/ninaverse';

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
        //$templatePath = __DIR__ . '/../views/' . $component . '.php';
        $templatePath = __DIR__ . "/../app/Views/{$component}.php";
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
            //include __DIR__ . '/../views/layout.php';
            include __DIR__ . '/../app/Views/theme/layout.php';
        } else {
            echo "Template not found: " . $templatePath;
        }
    }
}

