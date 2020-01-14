<?php

use Scooby\Helpers\Csrf;
use Scooby\Helpers\Session;
use CoffeeCode\Router\Router;

session_start();
if(!file_exists('vendor/autoload.php'))
die('Falha ao executar o autoload, por favor rode o comando composer install no termainal e recarregue a pagina novamente');
require_once 'vendor/autoload.php';
require_once 'App/Config/config.php';
require_once 'System/Core/Minifier.php';
require_once 'App/Config/lang/'.SITE_LANG.'.php';
Session::sessionTokenGenerate();
if(!Session::sessionTokenValidade()){
    die('Opss... Algo saiu errado por favor tente novamente');
}
Csrf::csrfTokengenerate();
if (ENV === 'development') {
    $whoops = new \Whoops\Run;
    $errorPage = new Whoops\Handler\PrettyPageHandler();
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $errorPage->setPageTitle("Opss... Algo deu errado!");
    $errorPage->setEditor("vscode");
    $whoops->pushHandler($errorPage);
    $whoops->register();
}
$op = new \CoffeeCode\Optimizer\Optimizer();
define('OPTIMIZE', $op->optimize(
    SITE_NAME,
    SITE_DESCRIPTION,
    BASE_URL,
    SITE_ICON
)->render());
$router = new Router(BASE_URL);
$router->namespace('Scooby\Controllers');
require_once 'App/Routes/routes.php';
$router->group('ooops');
$router->get('/{errcode}', 'NotfoundController:index');
 $router->dispatch();
 if($router->error()){
     $router->redirect("/ooops/{$router->error()}");
 }