<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
//        'tns'            => env('DB_TNS', 'tns_string'),
//        'tns' => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=DESKTOP-1VVBKF3)(PORT=1521)) (CONNECT_DATA=(SERVICE_NAME=XE)))',
        'host'           => env('DB_HOST', ''),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', ''),
        'service_name'   => env('DB_SERVICE_NAME', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
        'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],
];
