<?php

use Scooby\Helpers\Cli;

class MakeMigration
{
    public static function execOptionMakeMigration()
    {
        $migrationName = Cli::getParam('Por favor, DIGITE o nome da Migration a ser criada. Use o formato CamelCase');
        $migrationName = ucfirst($migrationName);
        if (file_exists("App/Db/Migrations/$migrationName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            return;
        }

        $migration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
        if (!$migration) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }
        Cli::println("Migration $migrationName criada com sucesso em App/Db/Migrations/");
    }
}
