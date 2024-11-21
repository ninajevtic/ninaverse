<?php

namespace App\Views;

class TemplateEngine
{
    private array $components = [];

    public function registerComponent(Component $component): void
    {
        $this->components[$component->getName()] = $component;
    }

    public function generate(Component $component): string
    {
        // Obrada zavisnosti
        foreach ($component->getDependencies() as $dependencyName) {
            if (isset($this->components[$dependencyName])) {
                $dependency = $this->components[$dependencyName];
                $this->generate($dependency);
            }
        }

        // Procesiranje i renderovanje komponente
        $component->process();
        return $component->render();
    }
}