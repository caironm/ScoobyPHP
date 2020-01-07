<?php

use MatthiasMullie\Minify;

$minify = filter_input(INPUT_GET, 'minify', FILTER_VALIDATE_BOOLEAN);

if ($_SERVER['SERVER_NAME'] == 'localhost' or $minify) {
    /**
     * Minify Css
     */
    $minifierCss = new Minify\CSS();
    $cssDir = scandir(dirname(__DIR__, 2) . "/App/Public/assets/css/");
    foreach ($cssDir as $cssItem) {
        $cssFile = dirname(__DIR__, 2) . "/App/Public/assets/css/$cssItem";
        if (is_file($cssFile) and pathinfo($cssFile)['extension'] == "css") {
            if($_SERVER['SERVER_NAME'] == 'localhost'){
                @unlink(dirname(__DIR__, 2) . "/App/Public/assets/css/scooby.min.css");
            }
            $minifierCss->add($cssFile);
        }
    }
    $minifiedPath = dirname(__DIR__, 2) . "/App/Public/assets/css/scooby.min.css";
    $minifierCss->minify($minifiedPath);

    /**
     * Minify js
     */
    $minifierJs = new Minify\JS();
    $jsDir = scandir(dirname(__DIR__, 2) . "/App/Public/assets/js/");
    foreach ($jsDir as $jsItem) {
        $jsFile = dirname(__DIR__, 2) . "/App/Public/assets/js/$jsItem";
        if (is_file($jsFile) and pathinfo($jsFile)['extension'] == "js") {
            if($_SERVER['SERVER_NAME'] == 'localhost'){
                @unlink(dirname(__DIR__, 2) . "/App/Public/assets/js/scooby.min.js");
            }
            $minifierJs->add($jsFile);
        }
    }
    $minifiedPath = dirname(__DIR__, 2) . "/App/Public/assets/js/scooby.min.js";
    $minifierJs->minify($minifiedPath);
}
