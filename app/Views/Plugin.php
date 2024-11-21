<?php

namespace App\Views;

// Klasa Plugin - nema template, samo niz vrednosti
class Plugin extends Component
{
    public function process(): void
    {
        // Obrada specifičnih vrednosti za plugin
        $this->values = ["plugin_key" => "plugin_value"];
    }

    public function render(): string
    {
        // Plugin nema template, samo vraća vrednosti
        return json_encode($this->values);
    }
}