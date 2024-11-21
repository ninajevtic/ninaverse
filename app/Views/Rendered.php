<?php

namespace App\Views;

// Klasa za generisanje sadržaja sa obradom zavisnosti
class Renderer
{
    private $components = [];

    public function addComponent(Component $component)
    {
        $this->components[$component->getName()] = $component;
    }

    public function render(Component $component, array &$rendered = [])
    {
        if (isset($rendered[$component->getName()])) {
            return; // Komponenta je već obrađena
        }

        // Obrada zavisnosti
        foreach ($component->getDependencies() as $dependencyName) {
            if (isset($this->components[$dependencyName])) {
                $this->render($this->components[$dependencyName], $rendered);
            }
        }

        // Generisanje trenutne komponente
        $component->generate();
        $rendered[$component->getName()] = $component->getValues();
    }
}

