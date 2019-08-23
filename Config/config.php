<?php
header("Content-type: text/html;charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');
require_once 'env.php';

if(ENV == 'development'){
    //define a url base do sistema
    define("BASE_URL", "http://localhost/ScoobyPHP/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "http://localhost/ScoobyPHP/node_modules/");

    //define a url para a pasta assets
    define("ASSET", "http://localhost/ScoobyPHP/Public/assets/");
    
    //Url base para caso o controller não seja indicado na url
    define("HOME", "Home");

    error_reporting(E_ALL);
    
}else if(ENV == 'production'){

     //define a url base do sistema
     define("BASE_URL", "http://url_do_site/");

     //define a url para a pasta assets
     define("ASSET", "http://url_do_site/Public/assets/");
     
     //Url base para caso o controller não seja indicado na url
     define("HOME", "Home");

    error_reporting(0);
}

