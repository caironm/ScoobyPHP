<?php

date_default_timezone_set('America/Sao_Paulo');
require_once 'env.php';

if (ENV == 'development') {

    //define o nome do site em desenvolvimento
    define('APP_NAME', 'ScoobyPHP');

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o idioma das menssagens exibidas automaticamente pelo o frameowok em desenvolvimento
    define('SITE_LANG', 'pt-br');


    //define a url base do sistema
    define("BASE_URL", "/");

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', 'ooops');

    error_reporting(E_ALL);
} else if (ENV == 'production') {

    //define o nome do site em desenvolvimento
    define('APP_NAME', 'Nome em produção');

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o idioma das menssagens exibidas automaticamente pelo o frameowok em produção
    define('SITE_LANG', 'pt_br');

    //define a url base do sistema
    define("BASE_URL", "/");

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', 'ooops');

    error_reporting(0);
}
