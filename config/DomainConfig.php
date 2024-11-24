<?php

namespace Config;

/**
 * Class DomainConfig
 *
 * This class defines constants for configuring the application's domain and base paths.
 * It provides multiple base paths relative to the server root and a list of full base URLs
 * for the application, supporting different environments (local and production).
 */
class DomainConfig
{
    /**
     * The base paths of the application relative to the server root.
     * These paths define where the application is located within the server's file structure.
     * Examples:
     * - '/' represents the root directory of the server.
     * - '/ninaverse' represents a subdirectory where the application is hosted.
     */
    const BASE_PATH = '/ninaverse/';
    //const BASE_PATH = '/';

    /**
     * A list of full base URLs for accessing the application.
     * Each URL includes the protocol (HTTP/HTTPS) and hostname, and optionally a path.
     * These URLs are used for routing and linking within different environments:
     * - 'http://localhost/ninaverse' for local development in a subdirectory.
     * - 'http://localhost/' for local development in the root directory.
     * - 'https://ninaverse.cloud/' for production deployment on the primary domain.
     * - 'https://www.ninaverse.cloud/' for production deployment with 'www'.
     */
    const FULL_BASE_PATH = [
        'http://localhost/ninaverse',
        'http://localhost/',
        'https://ninaverse.cloud/',
        'https://www.ninaverse.cloud/',
    ];
}
