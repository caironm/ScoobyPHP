<?php

use Helpers\Auth;

//rotas sem autenticação
$router->group(null);
$router->get('/', 'HomeController:index');

//rotas autenticadas
if (Auth::authValidation()) {
    //
}
