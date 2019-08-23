<?php

require_once 'env.php';
use Illuminate\Database\Capsule\Manager as db;

$capsule = new db;

if(ENV === 'development'){
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'scoobyphp',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
}else if (ENV === 'production'){
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'Your_database_host',
        'database'  => 'Your _database_name',
        'username'  => 'Your_username',
        'password'  => 'Your_password',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
}

$capsule->setAsGlobal();
$capsule->bootEloquent();