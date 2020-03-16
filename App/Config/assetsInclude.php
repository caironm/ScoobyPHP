<?php

$assets = [
    'css' => [
        "<link rel='stylesheet' href='".NODE_MODULES."animate.css/animate.min.css'>",
        "<link rel='stylesheet' href='".NODE_MODULES."izitoast/dist/css/iziToast.min.css'>",
        "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>",
        "<link href='https://fonts.googleapis.com/css?family=Cinzel&display=swap' rel='stylesheet'>",
        "<link rel='stylesheet' href='System/MinifyFiles/min-css/scooby".ASSETS_HASH.".min.css'>",
        "<link rel='stylesheet' href='".ASSET."css/404.css'>"
    ],
    'js' => [
        "<script src='".NODE_MODULES."jquery/dist/jquery.min.js'></script>",
        "<script src='".NODE_MODULES."sweetalert2/dist/sweetalert2.all.min.js'></script>",
        "<script src='".NODE_MODULES."izitoast/dist/js/iziToast.min.js'></script>",
        "<script src='".NODE_MODULES."axios/dist/axios.min.js'></script>",
        "<script src='System/MinifyFiles/min-js/scooby".ASSETS_HASH.".min.js'></script>"
    ]
];
