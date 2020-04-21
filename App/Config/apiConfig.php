<?php

// Definir se a aplicação será uma API ou um projeto WEB monolítico 
define('IS_API', false);

// Hash para encriptação de jwt
//OBS: É EXTREMAMENTE IMPORTANTE SUBSTITUIR ESTA CHAVE POR UMA OUTRA CHAVE PARA A SEGURANÇA DA APLICAÇÃO
define('SECRET_KEY', 'secret');

define('ORIGIN_ALLOW', '*');

define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

define('CREDENTIALS_ALLOW', true);