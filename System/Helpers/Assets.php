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
    public static function loadCss(): void
    {
        require 'App/Config/assetsInclude.php';
        if(CSS['name'] == 'materialize') {
            echo "<link rel='stylesheet' href='".NODE_MODULES."materialize-css/dist/css/materialize.min.css'>";
          } else {
            echo "<link rel='stylesheet' href='".CSS['cssPath']."'>";
          }
        foreach ($assets['css'] as $cssFile) {
            echo $cssFile;
        }
    }

    /**
     * Carrega os arquivos de js da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function loadJs(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($assets['js'] as $jsFile) {
            echo $jsFile;
        }
        if(CSS['name'] == 'materialize') {
            echo "<script src='".NODE_MODULES."materialize-css/dist/js/materialize.min.js'></script>";
            
          } else {
            echo "<script src='".CSS['jsPath']."'></script>";
          }
    }
}