<?php

return [
    'default' => 'mysql',
    'migrations' => 'migrations',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host'      => env('DB_HOST'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'port'      => env('DB_PORT'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
        'mysql2' => [
            'driver'    => 'mysql',
            'host'      => env('DB2_HOST'),
            'database'  => env('DB2_DATABASE'),
            'username'  => env('DB2_USERNAME'),
            'password'  => env('DB2_PASSWORD'),
            'port'      => env('DB_PORT'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ]
];
