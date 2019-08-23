<?php

header("Content-type: text/html;charset=utf-8");
require_once 'env.php';
global $db;
$config = [];

if(ENV == 'development'){

    //configuração para banco de dados local

    $config['dbname'] = '';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
    error_reporting(E_ALL);
    
}else if(ENV == 'production'){

     //configuiração para banco de dados remoto 
    $config['dbname'] = 'remote_database_name';
    $config['host'] = 'remote_host';
    $config['dbuser'] = 'username';
    $config['dbpass'] = 'pass';
    error_reporting(0);
}
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass'],[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
} catch (PDOExeption $e) {
    die($e->getMessage());
}
