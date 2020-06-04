<?php

return [
    /*Options (core, illuminate)*/
    'baseModel' => 'illuminate',

    /*Options (mysql, sqlite)*/
    'driver' => 'sqlite',

    'sqlite' => [
        'database' => 'database.db'
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