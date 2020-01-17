<?php

use Scooby\Helpers\Auth as autentication;

//rotas sem autenticação
$route->group(null);
$route->get('/', 'HomeController@index');

//rotas autenticadas 
if (autentication::authValidation()) {
    // ao tentar acessar uma rota e a autenticação falhar,
    // a rota de 404 será executada
}
