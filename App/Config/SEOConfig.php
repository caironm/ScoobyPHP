<?php

require_once 'env.php';

if (ENV == 'development') {

    // Icone do site a ser desenvolvido
    define('SITE_ICON', 'App/Public/assets/img/scooby_logo.svg');

    // Descrição do site a ser criado
    define('SITE_DESCRIPTION', 'descrição do site');

    // Defina as palavras chave do seu projeto
    define('KEYWORDS', ['MVC', 'Framework', 'php', 'rest', 'api', 'restfull']);
    
} else if (ENV == 'production') {

    // Icone do site a ser desenvolvido
    define('SITE_ICON', 'Caminho do logo em produção');

    // Descrição do site a ser criado
    define('SITE_DESCRIPTION', 'Descrição do site em produção');

    // Defina as palavras chave do seu projeto
    define('KEYWORDS', ['MVC', 'Framework', 'php']);
}
