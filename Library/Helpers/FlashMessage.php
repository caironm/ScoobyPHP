<?php

namespace Helpers;

class FlashMessage
{
    /**
     * Exibe uma msg para o usuário
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @return void
     */
    public static function msg(string $title, string $body, string $type = "")
    {
        require_once "App/Views/Templates/Header.twig";
        $msg = <<<HTML
        <script>
            Swal.fire(
            "$title",
            "$body",
            "$type"
            )
        </script>
HTML;
        return $msg;
    }

    /**
     * Exibe uma menssagem para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param string $url
     * @return void
     */
    public static function msgWithHref(string $title, string $body, string $type = "", string $url)
    {
        require_once "App/Views/Templates/Header.twig";
        $url = BASE_URL.$url;
        $msg = <<<HTML
        <script>
            Swal.fire(
            "$title",
            "$body",
            "$type"
        ).then(function(){
            window.location.href="$url";
        })
        </script>
HTML;
        return $msg;
    }  
}