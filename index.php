<?php

use Helpers\Csrf;
use Helpers\Session;

session_start();
require_once 'vendor/autoload.php';
require_once 'Config/config.php';
require_once 'Library/Core/Minifier.php';
require_once 'Config/routes.php';
Session::sessionTokenGenerate();
Csrf::csrfTokengenerate();
$c = new Core\Core;
Session::sessionTokenGenerate();
Session::sessionTokenValidade();

if (ENV !== 'production') {
    $whoops = new \Whoops\Run;
    $errorPage = new Whoops\Handler\PrettyPageHandler();
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $errorPage->setPageTitle("Opss... Algo deu errado!");
    $errorPage->setEditor("vscode");
    $whoops->pushHandler($errorPage);
    $whoops->register();
}
$c->run();
