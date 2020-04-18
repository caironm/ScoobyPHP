<?php

use Scooby\Helpers\Cli;

class MakeNewDb
{
    public static function execOptionMakeNewDb()
    {
        Cli::println('Você optou por criar um novo banco de dados.');
        $name = Cli::getParam('Por favor, DIGITE o nome do Banco a ser criada');
        try {
            $conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        } catch (Exception $e) {
            Cli::println('Um erro inesperado ocorreu, por favor tente mais tarde.');
            Cli::println('');
            Cli::println($e->getMessage());
            return;
        }
        $test = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");
        if ($test->fetchColumn()) {
            Cli::println('Opss...: Banco de dados já existente, deseja se conectar a ele ?');
            $connect = Cli::getParam('DIGITE: Y para sim ou N para não');
            if ($connect == 'y' or $connect == 'Y') {
                $dbUser = Cli::getParam('Por favor digite o usuário do banco de dados ' . $name);
                $dbpass = Cli::getParam('por favor digite a senha do usuário do banco de dados ' . $name);
                $connectionUpdate = file_get_contents('App/Config/databaseConfig.php');
                $connectionUpdate = strtr($connectionUpdate, [
                    "'DB_NAME', ''" =>  "'DB_NAME', '$name'",
                    "'DB_USER', 'root'" =>  "'DB_USER', '$dbUser'",
                    "'DB_PASS', ''" =>  "'DB_PASS', '$dbpass'"
                ]);
                $f = fopen("App/Config/databaseConfig.php", 'w+');
                if ($f == false) {
                    Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                    return;
                }
                fwrite($f, $connectionUpdate);
                if ($f == false) {
                    Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                    return;
                }
                fclose($f);
                Cli::println('Banco de dados ' . $name . ' conectado com sucesso em App/Config/databaseConfig.php');
            } else {
                Cli::println('Operação cancelada pelo usuário');
                return;
            }
        }
        $create = $conn->query("CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_general_ci;");
        if ($create) {
            Cli::println("BANCO DE DADOS $name Criado com sucess");
            $configDb = file_get_contents('App/Config/databaseConfig.php');
            $configDb = strtr($configDb, [
                "'DB_NAME', ''" =>  "'DB_NAME', '$name'"
            ]);
            $f = fopen("App/Config/databaseConfig.php", 'w+');
            if ($f == false) {
                Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                return;
            }
            fwrite($f, $configDb);
            if ($f == false) {
                Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                return;
            }
            fclose($f);
            Cli::println('DB_NAME alterado com sucesso em App/Config/databaseConfig.php');
        } else {
            Cli::println("Um erro inesperado ocorreu, por favor tente mais tarde.");
        }
    }
}
