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

function current_page_url(){
    $page_url   = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $page_url .= 's';
    }
    return $page_url.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
$referrer = null;
if(isset($_SESSION['referrer'])){
    $referrer   = $_SESSION['referrer'];
} elseif(isset($_SERVER['HTTP_REFERER'])){
    $referrer   = $_SERVER['HTTP_REFERER'];
}else{
    //$_SESSION['referrer'] = '';
}
$_SESSION['referrer']   = current_page_url();
$back = explode('/', $referrer);
if($back == null or !isset($back)) $_SESSION['ACTION_PREVIOUS'] = 'Notfound';
if(sizeof($back) < 4) $back[4] = '';
$_SESSION['ACTION_PREVIOUS'] = $back[4];

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
