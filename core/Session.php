<?php

namespace Core;

class Session
{
    /**
     * Pokreće sesiju ako već nije pokrenuta.
     *
     * @return void
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Dohvata vrednost iz sesije.
     *
     * @param string $key     Ključ vrednosti u sesiji.
     * @param mixed  $default Zadana vrednost ako ključ ne postoji.
     *
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Postavlja vrednost u sesiju.
     *
     * @param string $key   Ključ vrednosti u sesiji.
     * @param mixed  $value Vrednost za postavljanje.
     *
     * @return void
     */
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Generiše i postavlja CSRF token u sesiju ako već ne postoji.
     *
     * @return string Generisani CSRF token.
     */
    public static function getCsrfToken(): string
    {
        if (!self::get('csrf_token')) {
            self::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return self::get('csrf_token');
    }

    /**
     * Uklanja podatke iz sesije.
     *
     * @param string $key Ključ vrednosti u sesiji.
     *
     * @return void
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }
}
