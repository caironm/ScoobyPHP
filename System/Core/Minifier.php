<?php

use MatthiasMullie\Minify;
use Scooby\Helpers\Minifier;

$minify = filter_input(INPUT_GET, 'minify', FILTER_VALIDATE_BOOLEAN);
if ($_SERVER['SERVER_NAME'] == 'localhost' or $minify) {
    $jsDir = scandir(dirname(__DIR__, 2)."/App/Public/assets/js/");
    $cssDir = scandir(dirname(__DIR__, 2)."/App/Public/assets/css/");
    array_shift($cssDir);
    array_shift($cssDir);
    array_shift($jsDir);
    array_shift($jsDir);
    $keyCss = array_search('min-css', $cssDir);
    if ($keyCss !== false) {
        unset($cssDir[$keyCss]);
    }
    $keyJs = array_search('min-js', $jsDir);
    if ($keyJs !== false) {
        unset($jsDir[$keyJs]);
    }
    $jsMinDir = scandir("System/MinifyFiles/min-js/");
    $cssMinDir = scandir("System/MinifyFiles/min-css/");
    array_shift($cssMinDir);
    array_shift($cssMinDir);
    array_shift($jsMinDir);
    array_shift($jsMinDir);
    foreach ($cssMinDir as $MinFile) {
        $file = explode('.', $MinFile);
        if (!file_exists('App/Public/assets/css/'.$file[0].'.css')) {
            $remove = $file[0].'.min.css';
            @unlink('System/MinifyFiles/min-css/'.$remove);
        }
    }
    foreach ($jsMinDir as $MinFile) {
        $file = explode('.', $MinFile);
        if (!file_exists('App/Public/assets/js/'.$file[0].'.js')) {
            $remove = $file[0].'.min.js';
            @unlink('System/MinifyFiles/min-js/'.$remove);
        }
    }
    foreach ($cssDir as $cssFile) {
        $fileName = explode(".", $cssFile);
        $mini = Minifier::minify('App/Public/assets/css', 'System/MinifyFiles/min-css', "{$fileName[0]}", 'css');
    }
    foreach ($jsDir as $jsFile) {
        $fileName = explode(".", $jsFile);
        $mini = Minifier::minify('App/Public/assets/js', 'System/MinifyFiles/min-js', "{$fileName[0]}", 'js');
    }
}
