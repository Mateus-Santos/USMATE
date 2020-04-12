<?php

return [
    /**
     * Options (mysql, sqlite)
     */
    'driver' => 'sqlite',

    'sqlite' => [
        'host' => 'database.db',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci'
    ],
    'mysql' =>[
        'host' => 'localhost',
        'database' => 'banco_teste', //nome do banco
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci'
    ]
];