<?php

use Scooby\Helpers\Auth as autentication;

//rotas sem autenticação
$router->group(null);
$router->get('/', 'HomeController@index');

//rotas autenticadas 
if (autentication::authValidation()) {
    // ao tentar acessar uma rota e a autenticação falhar,
    // a rota de 404 será executada
}
