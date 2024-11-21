<?php

namespace App\Views;

// Klasa Theme - nema funkcionalnost, ali ima template
class Theme extends Component
{
    protected array $positions = [];
    protected bool $isProcessed = false; // Dodaj ovo

    public function __construct(string $name, array $dependencies = [])
    {
        parent::__construct($name, $dependencies);

        // Inicijalizacija pozicija
        $this->positions = [];
    }

    public function process(): void
    {
        if ($this->isProcessed) {
            return;
        }

        $this->positions = ["header" => "", "footer" => ""];
        $this->isProcessed = true;
    }

    public function render(): string
    {
        // Generiše template i zamenjuje pozicije sa vrednostima
        $output = "<div>Theme Template<br>";
        foreach ($this->positions as $key => $value) {
            $output .= "$key: " . ($value ?: "Empty") . "<br>";
        }
        $output .= "</div>";
        return $output;
    }

    public function setPositionValue(string $position, string $value): void
    {
        if (array_key_exists($position, $this->positions)) {
            $this->positions[$position] = $value;
        } else {
            echo '<pre>Invalid position: ' . $position . '</pre>';
        }
    }

    public function getPositions(): array
    {
        return $this->positions;
    }
}