<?php

namespace Scooby\Helpers;

class HttpErrorResponse
{
    /**
     * Retorna um inteiro com o código do erro http
     *
     * @return integer
     */
    public static function httpGetCodeError(): int
    {
        if (isset($_SESSION['httpCode'])) {
            $code = $_SESSION['httpCode'];
        }
        return $code;
    }

    /**
     * Recebe o código de erro http e retorna uma string com sua determinada menssagem
     *
     * @param string $errorCode
     * @return string
     */
    public static function httpGetMsgError(): string
    {
        if (in_array($_SESSION['httpCode'], array_keys($GLOBALS))) {
            $code = $GLOBALS[$_SESSION['httpCode']];
        } else {
            $code = 'Unknown error';
        }
        return $code;
    }
}
