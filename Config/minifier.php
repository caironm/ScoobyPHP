<?php

use MatthiasMullie\Minify;

$minify = filter_input(INPUT_GET, "minify", FILTER_VALIDATE_BOOLEAN);
if ($_SERVER['SERVER_NAME'] == 'localhost' or $minify) {
    /**
     * Minify Css
     */
    $minifierCss = new Minify\CSS();
    $cssDir = scandir(dirname(__DIR__, 1)."/Public/assets/css/");
    foreach ($cssDir as $cssItem) {
        $cssFile = dirname(__DIR__, 1)."/Public/assets/css/$cssItem";
        if (is_file($cssFile) and pathinfo($cssFile)['extension'] == "css") {
            $minifierCss->add($cssFile);
        }
    }
    $minifiedPath = dirname(__DIR__, 1)."/Public/assets/css/scooby.min.css";
    $minifierCss->minify($minifiedPath);

    /**
     * Minify js
     */
    $minifierJs = new Minify\JS();
    $jsDir = scandir(dirname(__DIR__, 1)."/Public/assets/js/");
    foreach ($jsDir as $jsItem) {
        $jsFile = dirname(__DIR__, 1)."/Public/assets/js/$jsItem";
        if (is_file($jsFile) and pathinfo($jsFile)['extension'] == "js") {
            $minifierJs->add($jsFile);
        }
    }
    $minifiedPath = dirname(__DIR__, 1)."/Public/assets/js/scooby.min.js";
    $minifierJs->minify($minifiedPath);
}