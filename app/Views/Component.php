<?php

namespace App\Views;
// Apstraktna klasa Component
abstract class Component
{
    protected string $name;
    protected array $dependencies = [];
    protected array $values = [];

    public function __construct(string $name, array $dependencies = [])
    {
        $this->name = $name;
        $this->dependencies = $dependencies;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    abstract public function render(): string;

    abstract public function process(): void;
}