<?php

use Scooby\Helpers\Cli;

class MakeModel
{
    public static function execOptionMakeModel()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $content);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");
    }

    public static function execOptionMakeModelMigration()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        $migrationName = $name . "CreateTable";
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $content);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");
        if (file_exists("App/Db/Migrations/$migrationName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
        if (!$modelMigration) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }
    }

    public static function execOptionMakeModelMigrationAndSeed()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        $migrationName = $name . "CreateTable";
        $seedName = $name . "Seed";
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $content);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");
        if (file_exists("App/Db/Migrations/$migrationName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
        if (!$modelMigration) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }
        if (file_exists("App/Db/Seeds/$seedName.php")) {
            Cli::println("ERROR: Seed já existente na pasta 'App/Db/Seeds/'");
            return;
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/seedFile.tpl');
        $seed = strtr($seed, [
            'dateNow' => date('d-m-y - H:i:a'),
            'users' => strtolower($name) . "s",
        ]);
        $f = fopen("App/Db/Seeds/$seedName.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fwrite($f, $seed);
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Seed {$seedName}Seed criada com sucesso em App/Db/Seeds/");
    }
}
