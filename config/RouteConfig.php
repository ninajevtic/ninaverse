<?php

namespace Config;

/**
 * Class RouteConfig
 *
 * This class defines the configuration for application routes, including components and their associated methods.
 * Each component and its methods can be toggled on or off using an "enabled" flag, allowing fine-grained control
 * over the availability of different parts of the application.
 */
class RouteConfig
{
    /**
     * Configuration for all application components and their methods.
     *
     * The structure is as follows:
     * - The `routes` key contains a list of all main components (pages or modules) in the application.
     * - Each component has an "enabled" key to determine whether the component is active or not.
     * - Components with associated methods (e.g., user actions like login and register) define these methods
     *   under a `method` key, with each method having its own "enabled" flag.
     *
     * Example:
     * - 'home': Enabled and accessible.
     * - 'user': Enabled, with the 'login' method enabled and 'register' method disabled.
     * - 'about': Disabled, making it inaccessible.
     * - '404': Disabled, representing a custom error page that is currently not in use.
     */
    const ROUTES = [
        'components' => [
            'home' => [
                'enabled' => true, // Home page is enabled and accessible.
            ],
            'user' => [
                'enabled' => true, // User component is enabled.
                'method' => [
                    'login' => ['enabled' => true], // Login method is enabled.
                    'register' => ['enabled' => false], // Register method is disabled.
                    'edit' => [ // Edit method is enabled and includes a parameter.
                                'enabled' => true,
                                'param' => 'userId', // Parameter required for the edit method.
                    ],
                ],
            ],
            'about' => [
                'enabled' => false, // About page is disabled and inaccessible.
            ],
            'contact' => [
                'enabled' => true, // Contact page is enabled and accessible.
            ],
            'error' => [
                'enabled' => false, // Custom 404 error page is disabled.
            ],
        ],
    ];
}
