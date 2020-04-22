<?php

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', false);

// Hash para encriptação do jwt
define('SECRET_KEY', 'c00735c671aeab7511672362833d116f4c83e8de0a0bace01c428ff4cf823242');

define('ORIGIN_ALLOW', '*');

define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

define('CREDENTIALS_ALLOW', true);
