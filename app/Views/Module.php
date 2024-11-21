<?php

namespace App\Views;

// Klasa Module - ima funkcionalnost i template
class Module extends Component
{
    private array $positions = [];

    public function process(): void
    {
        // Obrada vrednosti za modul
        $this->values = ["module_key" => "module_value"];
        $this->positions = ["position_1" => "module_content"];
    }

    public function render(): string
    {
        // Renderovanje šablona modula
        return "<div>Module Template: " . implode(", ", $this->positions) . "</div>";
    }
}
