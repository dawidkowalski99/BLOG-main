<?php

return [
    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    czas sesji
    */
    'lifetime' => 120,
    'expire_on_close' => false,

    /*
    szyfrowanie sesji(laravel ma swoje szyfrowanie)
    */

    'encrypt' => false,

    /*
    Lokalizacja pliku sesji
    */

    'files' => storage_path('framework/sessions'),

    /*
    Połączenie z bazą danych sesji
    */
    'connection' => null,

    /*
    Tabela bazy danych sesji
    */

    'table' => 'sessions',

    /*
    Magazyn cache dla sesji
    */

    'store' => null,
    'lottery' => [2, 100],

    /*
    Nazwa cookies dla sesji
    */

    'cookie' => 'laravel_session',

    /*
    Ścieżka dla cookies
    */

    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
    Dostęp tylko przez http
    */

    'http_only' => true,

];
