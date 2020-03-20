<?php

namespace Scooby\Helpers;

class Assets
{
    /**
     * Carrega os arquivos de css da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function headerLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        if(CSS['name'] == 'materialize') {
            echo "<link rel='stylesheet' href='".NODE_MODULES."materialize-css/dist/css/materialize.min.css'>";
          } else {
            echo "<link rel='stylesheet' href='".CSS['cssPath']."'>";
          }
        foreach ($html['header'] as $header) {
            echo $header;
        }
    }

    /**
     * Carrega os arquivos de js da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function bodyTopLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($html['bodyTop'] as $bodyTop) {
            echo $bodyTop;
        }
        if(CSS['name'] == 'materialize') {
            echo "<script src='".NODE_MODULES."materialize-css/dist/js/materialize.min.js'></script>";
            
          } else {
            echo "<script src='".CSS['jsPath']."'></script>";
          }
    }

    /**
     * Carrega os arquivos de js da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function bodyBottomLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($html['bodyBottom'] as $bodyBottom) {
            echo $bodyBottom;
        }
    }
}