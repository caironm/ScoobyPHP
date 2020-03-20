<?php
require_once 'vendor/autoload.php';
require_once 'App/Config/databaseConfig.php';

use Illuminate\Database\Capsule\Manager as database;

$capsule = new database;

$capsule->addConnection([
    'driver'    => DB_DRIVER,
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'charset'   => CHARSET,
    'collation' => COLLATION,
    'prefix'    => '',
    'options'   => DB_OPTIONS
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
