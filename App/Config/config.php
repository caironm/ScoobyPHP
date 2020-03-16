<?php
date_default_timezone_set('America/Sao_Paulo');
require_once 'env.php';

define('ASSETS_VERSION', 1);

define('ASSETS_HASH', '-'.md5(ASSETS_VERSION));

// Framework css para uso no frot-end, bootstrap, materializeq, semantic-ui e etc...
define('CSS', [
    'name' => 'materialize',
    'cssPath' => 'path/to/css',
    'jsPath' => 'path/to/js'
]);

// Icone do site a ser desenvolvido
define('SITE_ICON', 'App/Public/assets/img/scooby_logo.svg');

// Descrição do site a ser criado
define('SITE_DESCRIPTION', 'descrição do site');

if (ENV == 'development') {

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o nome do site em desenvolvimento
    define('SITE_NAME', 'ScoobyPHP');

    //define o idioma das menssagens exibidas automaticamente pelo o frameowok em desenvolvimento
    define('SITE_LANG', 'pt-br');

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

    //define a url base do sistema
    define("BASE_URL", "/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "/node_modules/");

    //define a url para a pasta assets
    define("ASSET", "/App/Public/assets/");

    //Define o endereço do servidor de email a ser utilizado em modo de desenvolvimento 
    define('SMTP', 'smtp.gmail.com');

    //Define o usuario do servidor de email em modo de desenvolvimento
    define('SMTP_USER', '');

    //Define a senha do usuario do servidor de email em modo de desenvolvimento 
    define('SMTP_PASS', '');

    //define a porta do servidor de email em modo de desenvolvimento
    define('SMTP_PORT', '465');

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de desenvolvimento
    define('SMTP_CETTIFICATE', 'ssl');

    error_reporting(E_ALL);
    
} elseif (ENV == 'production') {

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o nome do site em produção
    define('SITE_NAME', 'ScoobyPHP');

    //define o idioma das menssagens exibidas automaticamente pelo o frameowok em produção
    define('SITE_LANG', 'pt_br');

    //Define o nome do banco de dados a ser usado em produção
    define('DB_NAME', 'teste2');

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

    //define a url base do sistema
    define("BASE_URL", "/");

    //define a url para a pasta assets
    define("ASSET", "/App/Public/assets/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "/node_modules/");

    //Define o endereço do servidor de email a ser utilizado em modo de produção
    define('SMTP', 'smtp.gmail.com');

    //Define o usuario do servidor de email em modo de produção
    define('SMTP_USER', '');

    //Define a senha do usuario do servidor de email em modo de produção 
    define('SMTP_PASS', '');

    //define a porta do servidor de email em modo de produção
    define('SMTP_PORT', '465');

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de produção
    define('SMTP_CETTIFICATE', 'ssl');

    error_reporting(0);
}
