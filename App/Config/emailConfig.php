<?php

require_once 'env.php';

if (ENV == 'development') {
    //Define o endereço do servidor de email a ser utilizado em modo de desenvolvimento 
    define('SMTP', 'smtp.gmail.com');

    //Define o usuario do servidor de email em modo de desenvolvimento
    define('SMTP_USER', '');

    //Define a senha do usuario do servidor de email em modo de desenvolvimento 
    define('SMTP_PASS', '');

    //define a porta do servidor de email em modo de desenvolvimento
    define('SMTP_PORT', '465');

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de desenvolvimento
    define('SMTP_CETTIFICATE', 'ssl');
    
} else if (ENV == 'production') {

    //Define o endereço do servidor de email a ser utilizado em modo de produção
    define('SMTP', 'smtp.gmail.com');

    //Define o usuario do servidor de email em modo de produção
    define('SMTP_USER', '');

    //Define a senha do usuario do servidor de email em modo de produção 
    define('SMTP_PASS', '');

    //define a porta do servidor de email em modo de produção
    define('SMTP_PORT', '465');

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de produção
    define('SMTP_CETTIFICATE', 'ssl');
}
