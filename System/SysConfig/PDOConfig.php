<?php

require_once 'App/Config/env.php';
require_once 'App/Config/databaseConfig.php';
global $db;
$config = [];
if (ENV == 'development') {

    //configuração para banco de dados local

    $config['dbname'] = DB_NAME;
    $config['host'] = DB_HOST;
    $config['dbuser'] = DB_USER;
    $config['dbpass'] = DB_PASS;
    $config['dboptions'] = DB_OPTIONS;
    error_reporting(E_ALL);
} else if (ENV == 'production') {

    //configuiração para banco de dados remoto 
    $config['dbname'] = DB_NAME;
    $config['host'] = DB_HOST;
    $config['dbuser'] = DB_USER;
    $config['dbpass'] = DB_PASS;
    error_reporting(0);
}
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass'], $config['dboptions']);
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
