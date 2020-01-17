<?php

use Scooby\Helpers\Csrf;
use Scooby\Helpers\FlashMessage;
use Scooby\Helpers\Session as sess;

session_start();
if (!file_exists('vendor/autoload.php')) {
    die('Falha ao executar o autoload, por favor rode o comando composer install no termainal e recarregue a pagina novamente');
}
require_once 'vendor/autoload.php';
require_once 'App/Config/config.php';
require_once 'System/Core/Minifier.php';
require_once 'App/Config/lang/'.SITE_LANG.'.php';
sess::sessionTokenGenerate();
if (!sess::sessionTokenValidade()) {
    die('Opss... Algo saiu errado por favor tente novamente');
}
Csrf::csrfTokengenerate();
if (ENV === 'development') {
    $whoops = new \Whoops\Run;
    $errorPage = new Whoops\Handler\PrettyPageHandler();
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $errorPage->setPageTitle("Opss... Algo deu errado!");
    $errorPage->setEditor("vscode");
    $whoops->prependHandler($errorPage);
    $whoops->register();
}
$op = new \CoffeeCode\Optimizer\Optimizer();
define('OPTIMIZE', $op->optimize(
    SITE_NAME,
    SITE_DESCRIPTION,
    BASE_URL,
    SITE_ICON
)->render());
$route = new Scooby\Router\Router(BASE_URL);
$route->namespace('Scooby\Controllers');
$dir = scandir("App/Routes/");
$dir = (array) $dir;
array_shift($dir);
array_shift($dir);
foreach ($dir as $file) {
    require_once "App/Routes/$file";
}
$route->get('/denied', function() {
    FlashMessage::modalWithGoBack('PARE', 'Esta é uma área restrita, o Scooby_CLI é reservado para se trabalhar em linha de comando. Você sera redirecionado!', 'error');
});
$route->group('ooops');
$route->get('/{errcode}', 'NotfoundController@index');
$route->dispatch();
if ($route->error()) {
    $route->redirect("/ooops/{$route->error()}");
}
