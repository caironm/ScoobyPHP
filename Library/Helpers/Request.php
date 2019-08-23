<?php

namespace Helpers;

class Request
{
     /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return void
     */
    public static function input(string $inputName)
    {

        if(isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])){
            return htmlspecialchars(strip_tags(addslashes(trim($_REQUEST["$inputName"]))));
        }else{
            $helper = new Helper;
            $flashMessage  = $helper->flashMessage("Input ['$inputName'] não encontrado");
            //$flashMessage->setMessage();
            Redirect::redirectTo('failure');
        }
    }

    /**
     * Testa se o conteudo vindo do nput existe e não é vazio
     *
     * @param string $inputName
     * @return boolean
     */
    public static function has(string $inputName)
    {

        if(isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])){
            return true;
        }else{
            return false;
        }
    }
} 