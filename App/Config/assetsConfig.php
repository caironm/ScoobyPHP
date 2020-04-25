<?php
date_default_timezone_set('America/Sao_Paulo');
require_once 'env.php';

define('ASSETS_VERSION', 1);

define('ASSETS_HASH', '-'.md5(ASSETS_VERSION));

if (ENV == 'development') {

    //define a url para a pasta node_modules
    define("NODE_MODULES", "/node_modules/");

    //define a url para a pasta assets
    define("ASSET", "/App/Public/assets/");

} elseif (ENV == 'production') {

    //define a url para a pasta assets
    define("ASSET", "/App/Public/assets/");

    //define a url para a pasta node_modules
    define("NODE_MODULES", "/node_modules/");

}
