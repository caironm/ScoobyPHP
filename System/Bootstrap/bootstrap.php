<?php

use Scooby\Helpers\Csrf;
use Scooby\Helpers\Redirect;
use Scooby\Helpers\Session as sess;
use Scooby\Helpers\Jwt;

session_start();
if (!file_exists('vendor/autoload.php')) {
    die('Falha ao executar o autoload, por favor rode o comando composer install no terminal e recarregue a pagina novamente');
}
require_once 'vendor/autoload.php';
$configs = scandir('App/Config/');
array_shift($configs);
array_shift($configs);
foreach ($configs as $config) {
    if (
            $config != 'Lang' and
            $config != 'index.php' and
            $config != 'twigGlobalVariables.php' and
            $config != 'authConfig.php'
        ) {
        require_once "App/Config/$config";
    }
}
require_once 'System/Core/MiniFiles.php';
require_once 'App/Config/Lang/'.SITE_LANG.'.php';
if (IS_API === true) {
    Jwt::jwtKeyGenerate();
    header('Access-Control-Allow-Origin: '.ORIGIN_ALLOW.'');
    header('Access-Control-Allow-Methods: '.METHODS_ALLOW.'');
    header('Access-Control-Allow-Credentials: '.CREDENTIALS_ALLOW.'');
    header('Content-Type: application/json');
    header('Access-Control-Max-Age: 1728000');
    header("Content-Length: 0");
    header('Content-Type: application/json');
}
sess::sessionTokenGenerate();
$error = false;
if (!sess::sessionTokenValidade()) {
    //die('Opss... Algo saiu errado por favor tente novamente');
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
if (!isset($_SESSION['pageTitle']) or empty($_SESSION['pageTitle'])) {
    $_SESSION['pageTitle'] = APP_NAME;
}
MiniFiles::miniCss('App/Public/assets/css/');
MiniFiles::miniJs('App/Public/assets/js/');
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
    $url = $_SERVER['SERVER_NAME'];
    Redirect::redirectTo($url."/".ROUTE_ERROR."/");
});
$route->group(ROUTE_ERROR);
$route->get('/', 'NotfoundController@index');
$route->dispatch();
if ($route->error()) {
    $_SESSION['httpCode'] = $route->error();
    $route->redirect("/".ROUTE_ERROR."/");
}