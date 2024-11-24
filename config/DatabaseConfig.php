<?php

namespace config;

/**
 * Class DatabaseConfig
 *
 * This class defines constants for the database connection configuration.
 * It contains the host, database name, username, and password for connecting to the database.
 */
class DatabaseConfig
{
    /**
     * The hostname of the database server.
     * Default is 'localhost'.
     */
    const HOST = 'localhost';

    /**
     * The name of the database to connect to.
     * Default is 'ninaverse'.
     */
    const DATABASE = 'ninaverse';

    /**
     * The username for authenticating with the database.
     * Default is 'root'.
     */
    const USERNAME = 'root';

    /**
     * The password for authenticating with the database.
     * Default is an empty string (no password).
     */
    const PASSWORD = '';
}