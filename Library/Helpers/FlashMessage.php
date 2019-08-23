<?php

namespace Helpers;

class FlashMessage
{

    /**
     * Metodo construtor, cria a menssagem na variavel de sessão ['flashMessage']
     */
    public function __construct(string $msg)
    {
        $_SESSION['flashMessage'] = $msg;
    }

}
