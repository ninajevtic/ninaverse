<?php

namespace Core;

use Config\DomainConfig;
use Config\ControlConfig;

//validacija za url nema tacaka i nema sleseva, ti treba da uzmes sve posle domena www.xxx.com/
//expode url na segmente i protrcis kroz taj niz segmenata
//i da se validira svaki segment sa prostim regresom koji moze da protumaci samo mala slova i brojevi, samo crtice, cak i ne donja crta
//zlonamerni kod je nepropustim, ne trebada imas ni black listu nesto sto treba da proverava, nista od toga//
//sanitaze url je dobro
//sanitaze url dobijas tako sto filtriras svaki od segmenta i onda ga impolde sa crticama, ne filter var da se toliko oslonis, on je vise kao kontrola
//filetr var validira url, a mi zelimo da validiramo segmente
//razlikuj kontrole i kontrolere, kontrolere nam ne trebaju napravicemo samo jedan za ajax koji ce da ucitava kontrole
//ne treba to da radis u validatoru, da pozivas staticki metod configcontrol
//url ne moze da se validira na osnovu klasa koje imas zastupljene i u njima da trazis edit create i delete kljucne rece
//url treba da bude kombinacija brojeva, malis slova, crtica i slesa, nema nista drugo
//ne treba da se trim vrednost kada je string validan!!!pogotovo zbog duzine!!!
// nema smisl za validaciju stringa ova funkcija
//da li je nesto broj da je value i da li je numeric, moras da pitas specificne situacije, da li je broj u nekom rangu
//da li je ceo broj, da li ima 2 decimale, da nema 0 ispred sebe
//tip stringa treba da definises, tip je email, tip je user name, tip je adresa, tip je zip code, ne treba da pravis validator koji validira broj,
//treba, ali ne na ovaj nacin
//idealno bi bilo da ti imas svoj validator klasu gde ces ti definisati config, email i u nizu njegova patern, pa onda username i njegov patern
//ti hoces da imas univerzalni mehanizam kako kreiras tipove , i onda validator pitas da li je user name to, da li je email to
//da li je password i onda u konfiguraciji van samog validatora, validator je automatska klasa, njoj prosledjujes neki config
//i u tom configu imas neki niz, ovo mi je rexer za username, email ovo mi je regrex za email, ovo je regrex za email
//taj niz moze da ima pod nizove, da li su karakteri, da li je broj, da li je range
//ti za svaki tip mozes da definises metod koji ce da ti validira, npr. za ajax metod, domen, json
//metodi su sablonski, samo manji deo definicije tog tipa je to sto ti treba, da li je range, da li je broj, caracter i regularne expresije toga
//sve ovo za pojadnostavljenje
class Validator
{
    public static function validate($value, array $rules): bool
    {
        foreach ($rules as $rule => $params) {
            $isValid = match ($rule) {
                'string' => self::string($value, $params['min'] ?? 1, $params['max'] ?? INF),
                'numeric' => self::numeric($value, $params['min'] ?? null, $params['max'] ?? null),
                'email' => self::email($value),
                'url' => self::url($value),
                'boolean' => self::boolean($value),
                'regex' => self::regex($value, $params['pattern']),
                default => true,
            };

            if (!$isValid) {
                return false;
            }
        }

        return true;
    }

    //sa ovim ne radi
    //const BASE_PATH = 'http://localhost/ninaverse';
    //relativna putanja radi
    //const BASE_PATH = '/ninaverse';
    public static function url($url)
    {
        //echo $url;
        // 1. Proveri da li URL sadrži dozvoljene znakove
//        if (!preg_match('/^[a-zA-Z0-9\-\/\_\.\?=&]+$/', $url)) {
//            return false; // URL sadrži nedozvoljene znakove
//        }
        if (!preg_match('/^((http:\/\/localhost)|https:\/\/[a-zA-Z0-9\-\.]+)(\/[a-zA-Z0-9\-\/\_\.\?=&]*)?$/', $url)) {
            return false; // URL nije validan
        }

        // 2. Proveri da li URL sadrži zlonamerni kod
        $blacklist = ['<script>', '<?php', 'javascript:', 'data:', 'vbscript:'];
        foreach ($blacklist as $item) {
            if (stripos($url, $item) !== false) {
                return false; // URL sadrži zlonameran kod
            }
        }

        // 3. Sanitizuj URL
        //$sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);
        $sanitizedUrl = filter_var(trim($url), FILTER_SANITIZE_URL);
        // 4. Proveri da li je URL validan
        if (!filter_var($sanitizedUrl, FILTER_VALIDATE_URL)) {
            return false; // URL nije validan
        }

        // 5. Proveri specifični obrazac za validaciju URL-a
//        $pattern = sprintf(
//            '/^(http:\/\/localhost|https:\/\/(?!localhost)[a-zA-Z0-9.-]+)%s(\/(chat|user)?(\/[a-zA-Z0-9\-_]+(\/(edit(\/\d{10})?|create|delete(\/\d{10})?|view(\/\d{10})?)?)?)?)?$/',
//            preg_quote(DomainConfig::$BASE_PATH, '/') // Koristi samo relativnu putanju iz BASE_PATH
//        );
// Inicijalizuj ControlConfig ako je potrebno
        ControlConfig::initialize();

// Dobij kontrolere
        $controllers = ControlConfig::getControllers();
        //var_dump($controllers);

// Generiši deo regex-a za kontrolere (chat|user|...)
        $controllerPattern = implode('|', $controllers);
// Kreiraj ceo regex koristeći sprintf
        $pattern = sprintf(
            '/^(http:\/\/localhost|https:\/\/(?!localhost)[a-zA-Z0-9.-]+)%s(\/(%s)?(\/[a-zA-Z0-9\-_]+(\/(edit(\/\d{10})?|create|delete(\/\d{10})?|view(\/\d{10})?)?)?)?)?$/',
            preg_quote(DomainConfig::$BASE_PATH, '/'),
            $controllerPattern // Uključi dinamički generisan deo za kontrolere
        );

        if (!preg_match($pattern, $sanitizedUrl)) {
            return false; // URL ne odgovara definisanom obrascu
        }

        // URL je prošao sve provere
        return true;
    }

    //if(!Validator::string($_POST['body'],1,1000)){...}
    //is required, min caracter, max is infinity
    //body of no more than 1000 characters is required
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function numeric($value, $min = null, $max = null)
    {
        if (!is_numeric($value)) {
            return false;
        }
        if (!is_null($min) && $value < $min) {
            return false;
        }
        if (!is_null($max) && $value > $max) {
            return false;
        }
        return true;
    }

    public static function passwordHash($value)
    {
        return is_string($value) && strlen($value) === 60 && preg_match('/^\$2y\$/', $value) === 1;
    }

    /**
     * Validates a profile picture URL.
     *
     * @param string $url The profile picture URL to validate
     *
     * @return bool True if valid, false otherwise
     */
    public static function images(string $url): bool
    {
        // Validirajte osnovni URL format
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        // Dozvoljeni MIME tipovi slika
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH));

        if (!isset($pathInfo['extension']) || !in_array(strtolower($pathInfo['extension']), $allowedExtensions)) {
            return false;
        }

        // Opcionalno: Proverite veličinu URL-a (npr. max 2048 karaktera)
        if (strlen($url) > 2048) {
            return false;
        }

        return true;
    }

    public static function boolean($value)
    {
        return is_bool($value) || in_array($value, [0, 1, '0', '1'], true);
    }

    public static function timestamp($value)
    {
        return is_numeric($value) && (int)$value > 0 && (string)(int)$value === (string)$value;
    }

    public static function date($value, $format = 'Y-m-d')
    {
        $date = DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }

    public static function array($value)
    {
        return is_array($value);
    }

    public static function alphanumeric($value)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value) === 1;
    }

    public static function inArray($value, array $allowedValues)
    {
        return in_array($value, $allowedValues, true);
    }

    public static function regex($value, $pattern)
    {
        return preg_match($pattern, $value) === 1;
    }

    public static function ip($value)
    {
        return filter_var($value, FILTER_VALIDATE_IP);
    }

    public static function json($value)
    {
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function slug($value)
    {
        return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value) === 1;
    }

    public static function phone($value)
    {
        return preg_match('/^\+?[0-9]{7,15}$/', $value) === 1;
    }

    //if(! Validator::email('addvfff')){
    // not valid email
    //}
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates if a value is a valid case of the given enum.
     *
     * @param string|int $value The value to validate
     * @param string $enumClass The fully qualified class name of the enum
     *
     * @return bool Returns true if the value is valid, false otherwise
     */
    public static function enum($value, string $enumClass): bool
    {
        if (!enum_exists($enumClass)) {
            throw new \InvalidArgumentException("The class {$enumClass} is not a valid enum.");
        }

        return in_array($value, $enumClass::cases(), true);
    }
}