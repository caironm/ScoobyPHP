<?php

namespace Helpers;

class Auth
{
    /**
     * Metodo construtor que valida o login ou redireciona para o logout
     */
    public static function authValidation(): bool
    {
        if (
            isset($_SESSION['id'])
            and !empty($_SESSION['id'])
            and isset($_SESSION['statusLog'])
            and !empty($_SESSION['statusLog'])
            and $_SESSION['statusLog'] === true
        ) {
            if(!empty($_SESSION['ownerSession'])){
                Session::sessionTokenValidade();
            }
            return true;
        } else {
            $_SESSION['id'] = null;
            $_SESSION['statusLog'] = false;
            return false;
        }
    }


    /**
     * auxilia na validação de login de usuario caso o 
     * mesmo não esteja logado ele sera redirecionado para a tela de erro
     *
     * @return void
     */
    public static function authValidOrFail(): void
    {
        if(!self::authValidation()){
            Redirect::redirectTo('ooops/404');
        }
    }
}
