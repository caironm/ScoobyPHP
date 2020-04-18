<?php

require_once 'env.php';

if (ENV == 'development') {
    //Define o nome do banco de dados a ser usado em desenvolvimento
    define('DB_NAME', '');

    //Define o usuário do banco de dados em desenvolvimento 
    define('DB_USER', 'root');

    //Define a senha do usuário do banco de dados em desenvolvimento
    define('DB_PASS', '');

    //Define o driver de banco de dados
    define('DB_DRIVER', 'mysql');

    //Define o host do banco de dados em desenvolvimento
    define('DB_HOST', '127.0.0.1');

    //Define o charset para utf8 
    define('CHARSET', 'utf8');

    //Opções adicionais do DB
    define('DB_OPTIONS', [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    //Define a collation para utf8 general ci
    define('COLLATION', 'utf8_unicode_ci');

} else if (ENV == 'production') {
    
    //Define o nome do banco de dados a ser usado em produção
    define('DB_NAME', 'teste123');

    //Define o usuário do banco de dados em produção 
    define('DB_USER', '');

    //Define a senha do usuário do banco de dados em produção
    define('DB_PASS', '');

    //Define o driver de banco de dados
    define('DB_DRIVER', 'mysql');

    //Define o host do banco de dados em desenvolvimento
    define('DB_HOST', '');

    //Define o charset para utf8 
    define('CHARSET', 'utf8');

    //Opções adicionais do DB
    define('DB_OPTIONS', [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    //Define a collation para utf8 general ci
    define('COLLATION', 'utf8_unicode_ci');
}
