<?php 

namespace Helpers;

class Redirect
{

    /**
     * Executa um redirecionamento para a url indicada
     *
     * @param string $url
     * @return void
     */
    public static function redirectTo(string $url)
    {
        return header("Location:".BASE_URL."$url");
    }
}