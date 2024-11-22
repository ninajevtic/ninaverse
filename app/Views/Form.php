<?php

namespace App\Views;

use Core\Validator;

class Form
{
    private array $fields;
    private string $actionUrl;
    private string $method;
    private array $errors = [];

    public function __construct(string $actionUrl, string $method = 'POST', array $fields = [])
    {
        $this->actionUrl = $actionUrl;
        $this->method = strtoupper($method);
        $this->fields = $fields;
    }

    public function validate(array $data): bool
    {
        $this->errors = [];
        foreach ($this->fields as $fieldName => $fieldConfig) {
            $value = $data[$fieldName] ?? null;

            if ($fieldConfig['required'] && empty($value)) {
                $this->errors[$fieldName] = 'This field is required.';
                continue;
            }

            if (isset($fieldConfig['type'])) {
                $isValid = match ($fieldConfig['type']) {
                    'string' => Validator::string($value, $fieldConfig['min'] ?? 1, $fieldConfig['max'] ?? INF),
                    'numeric' => Validator::numeric($value, $fieldConfig['min'] ?? null, $fieldConfig['max'] ?? null),
                    'email' => Validator::email($value),
                    'url' => Validator::url($value),
                    'boolean' => Validator::boolean($value),
                    default => true,
                };

                if (!$isValid) {
                    $this->errors[$fieldName] = "Invalid value for {$fieldName}.";
                }
            }
        }

        return empty($this->errors);
    }

    public function render(): string
    {
        $formHtml = "<form action=\"{$this->actionUrl}\" method=\"{$this->method}\">";

        foreach ($this->fields as $name => $config) {
            //$errorClass = isset($this->errors[$name]) ? ' class="error-field"' : '';
            //css file
//            .error-field {
//                border: 2px solid black;
//}
            $errorClass = isset($this->errors[$name]) ? ' style="border: 2px solid black;"' : '';
            $formHtml .= <<<HTML
                <label for="{$name}">{$config['label']}:</label>
                <input type="{$config['inputType']}" id="{$name}" name="{$name}"{$errorClass}>
            HTML;

            if (isset($this->errors[$name])) {
                $formHtml .= "<span class=\"error\">{$this->errors[$name]}</span>";
            }
        }

        $formHtml .= '<button type="submit">Submit</button></form>';
        return $formHtml;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
