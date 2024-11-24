<?php

namespace Core;

class Component
{
    private $components = [];

    public function __construct(array $config)
    {
        $this->components = $config['components'] ?? [];
    }

    /**
     * Proverava da li je komponenta uključena
     */
    public function iscomponentEnabled(string $component): bool
    {
        return isset($this->components[$component]) && $this->components[$component]['enabled'] === true;
    }

    /**
     * Proverava da li je metoda uključena
     */
    public function isMethodEnabled(string $component, string $method): bool
    {
        return isset($this->components[$component]['methods'][$method]) &&
            $this->components[$component]['methods'][$method]['enabled'] === true;
    }

    /**
     * Dohvata sve omogućene komponente
     */
    public function getEnabledComponents(): array
    {
        return array_filter($this->components, function ($component) {
            return $component['enabled'] === true;
        });
    }

    /**
     * Dohvata sve omogućene metode za određenu komponentu
     */
    public function getEnabledmethods(string $component): array
    {
        if (!isset($this->components[$component]['methods'])) {
            return [];
        }

        return array_filter($this->components[$component]['methods'], function ($method) {
            return $method['enabled'] === true;
        });
    }

    /**
     * Omogućava komponentu
     */
    public function enablecomponent(string $component): void
    {
        if (isset($this->components[$component])) {
            $this->components[$component]['enabled'] = true;
        }
    }

    /**
     * Onemogućava komponentu
     */
    public function disablecomponent(string $component): void
    {
        if (isset($this->components[$component])) {
            $this->components[$component]['enabled'] = false;
        }
    }

    /**
     * Omogućava metodu
     */
    public function enablemethod(string $component, string $method): void
    {
        if (isset($this->components[$component]['methods'][$method])) {
            $this->components[$component]['methods'][$method]['enabled'] = true;
        }
    }

    /**
     * Onemogućava metodu
     */
    public function disablemethod(string $component, string $method): void
    {
        if (isset($this->components[$component]['methods'][$method])) {
            $this->components[$component]['methods'][$method]['enabled'] = false;
        }
    }
}