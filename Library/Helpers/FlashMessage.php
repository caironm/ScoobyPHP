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
    public static function msg(string $title, string $body, string $type = "show")
    {
        require_once "App/Views/Templates/Header.twig";
        $msg = <<<HTML
        <script>
            iziToast.$type({
                title: "$title",
                message: "$body",
                position: "topRight"

            });
        </script>
HTML;
        echo $msg;
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
    public static function msgWithHref(string $title, string $body, string $type = "show", string $url)
    {
        require_once "App/Views/Templates/Header.twig";
        $url = BASE_URL . $url;
        $msg = <<<HTML
        <script>
            iziToast.$type({
                title: "$title",
                message: "$body",
                position: "topRight",
                onClosing: function(){
                    window.location.href="$url";
                }
            });
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma menssagem para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param integer $value
     * @return void
     */
    public static function msgWithGoBack(string $title, string $body, string $type = "show", int $value = -1)
    {
        require_once "App/Views/Templates/Header.twig";
        $msg = <<<HTML
        <script>
           iziToast.$type({
                title: "$title",
                message: "$body",
                position: "topRight",
                onClosing: function(){
                    window.history.go($value);
                }
            });
        </script>
HTML;
        echo $msg;
    }
}
