<?php
require_once 'App/Config/config.php';
require_once 'App/Config/env.php';
return [
    'paths' => [
        'migrations' => __DIR__ . '/App/db/migrations',
        'seeds' => __DIR__ . '/App/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations_log',
        'default_database' => 'development',
        'development' => [
            'adapter' => DB_DRIVER,
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'port' => 3306,
            'charset' => CHARSET
        ],
        'production' => [
            'adapter' => DB_DRIVER,
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'port' => 3306,
            'charset' => CHARSET
        ]
    ],
    'version_order' => 'creation'
];
