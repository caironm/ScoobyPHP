<?php

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', false);

// Hash para encriptação do jwt unico, gerado ao criar o projeto
define('SECRET_KEY', 'secret');

define('ORIGIN_ALLOW', '*');

define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

define('CREDENTIALS_ALLOW', true);
