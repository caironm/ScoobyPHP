<?php

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', false);

// Hash para encriptação do jwt unico, gerado ao criar o projeto
define('SECRET_KEY', '76783e11c38704ce746fa4f01cf4c85cb5db840077d4d4e4a4bf250824f155bb');

define('ORIGIN_ALLOW', '*');

define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

define('CREDENTIALS_ALLOW', true);
