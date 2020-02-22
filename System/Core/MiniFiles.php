<?php

use MatthiasMullie\Minify;
use Scooby\Helpers\Minifier;

class MiniFiles
{
    public static function miniCss(string $path = 'App/Public/assets/css', string $savePath = 'System/MinifyFiles/min-css')
    {
        $fileName = 'scooby-'.md5(ASSETS_VERSION).'.min.css';
        $files = scandir($path);
        array_shift($files);
        array_shift($files);
        if (file_exists($savePath.'/'.$fileName)) {
            return false;
        }
        $m = new Minify\CSS();
        foreach ($files as $file) {
            $m->add($path.'/'.$file);
        }
        $m->minify($savePath.'/'.$fileName);
    }

    public static function miniJs(string $path = 'App/Public/assets/js', string $savePath = 'System/MinifyFiles/min-js')
    {
        $fileName = 'scooby-'.md5(ASSETS_VERSION).'.min.js';
        $files = scandir($path);
        array_shift($files);
        array_shift($files);
        if (file_exists($savePath.'/'.$fileName)) {
            return false;
        }
        $m = new Minify\JS();
        foreach ($files as $file) {
            $m->add($path.'/'.$file);
        }
        $m->minify($savePath.'/'.$fileName);
    }
}





