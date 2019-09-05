<?php

namespace Helpers;

class Cookie
{
    /**
     * Cria um novo cookie
     *
     * @param string $cookieName
     * @param string $cookieValue
     * @param integer $expire
     * @return void
     */
    public static function setCookie(string $cookieName, string $cookieValue, int $expire = 999999)
    {
        return setCookie($cookieName, $cookieValue, time() + $expire);
    }

    /**
     * Cria um cookie sem prazo para expirar
     *
     * @param string $cookieName
     * @param string $cookieValue
     * @return void
     */
    public static function setCookieForever(string $cookieName, string $cookieValue)
    {
        return setCookie($cookieName, $cookieValue);
    }

    /**
     * Retorna o valor do cookie
     *
     * @param string $cookieName
     * @return void
     */
    public static function getCookie(string $cookieName)
    {
        if(!isset($_COOKIE[$cookieName]) or empty($_COOKIE[$cookieName])){
            return false;
        }
            return $_COOKIE[$cookieName];
    }

    /**
     * Retorna e apaga o valor do cookie
     *
     * @param string $cookieName
     * @return void
     */
    public static function getCookieAndErase(string $cookieName)
    {
        if(!isset($_COOKIE[$cookieName]) or empty($_COOKIE[$cookieName])){
            return false;
        }
            echo $_COOKIE[$cookieName];
            return $_COOKIE[$cookieName] = "";  
    }

    /**
     * Destroy o cookie existente
     *
     * @param string $cookieName
     * @return void
     */
    public static function cookieDestroy(string $cookieName)
    {
        if(!isset($_COOKIE[$cookieName])){
            return false;
        }
            unset($_COOKIE[$cookieName]);
            return true;     
    }
}
