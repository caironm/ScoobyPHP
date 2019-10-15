<?php
header("Content-type: text/html;charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');
require_once 'env.php';

if (ENV == 'development') {
    //define a url base do sistema
    define("BASE_URL", "http://localhost/ScoobyPHP/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "http://localhost/ScoobyPHP/node_modules/");

    //define a url para a pasta assets
    define("ASSET", "http://localhost/ScoobyPHP/Public/assets/");
    
    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    error_reporting(E_ALL);
} elseif (ENV == 'production') {

     //define a url base do sistema
    define("BASE_URL", "http://YOUR_URL/");

    //define a url para a pasta assets
    define("ASSET", "http://YOUR_URL/Public/assets/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "http://YOUR_URL/node_modules/");
     
    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    error_reporting(0);
}
