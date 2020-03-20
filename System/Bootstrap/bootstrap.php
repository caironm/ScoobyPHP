<?php

use Scooby\Helpers\Csrf;
use Scooby\Helpers\FlashMessage;
use Scooby\Helpers\Session as sess;

session_start();
if (!file_exists('vendor/autoload.php')) {
    die('Falha ao executar o autoload, por favor rode o comando composer install no terminal e recarregue a pagina novamente');
}
require_once 'vendor/autoload.php';
require_once 'App/Config/assetsConfig.php';
require_once 'App/Config/appConfig.php';
require_once 'App/Config/emailConfig.php';
require_once 'App/Config/databaseConfig.php';
require_once 'App/Config/SEOConfig.php';
require_once 'App/Config/assetsInclude.php';
require_once 'System/Core/MiniFiles.php';
require_once 'App/Config/Lang/'.SITE_LANG.'.php';
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
    FlashMessage::modalWithGoBack('PARE', 'Esta é uma área restrita, o Scooby_CLI é reservado para se trabalhar em linha de comando. Você sera redirecionado!', 'error');
});

$route->group(ROUTE_ERROR);
$route->get('/', 'NotfoundController@index');
$route->dispatch();
if ($route->error()) {
    $_SESSION['httpCode'] = $route->error();
    $route->redirect("/".ROUTE_ERROR."/");
}
