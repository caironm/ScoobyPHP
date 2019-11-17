<?php
require_once 'vendor/autoload.php';
require_once 'Config/env.php';
require_once 'Config/config.php';

use Helpers\FlashMessage;

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    FlashMessage::msgWithGoBack('PARE', 'Esta é uma área restrita, o Scooby_CLI é reservado para se trabalhar em linha de comando. Você sera redirecionado!', 'error');
    die;
}

$date = date('d-m-y - H:i:a');
echo "\r\n
     ____                  _                      ____ _     ___ 
    / ___|  ___ ___   ___ | |__  _   _           / ___| |   |_ _|
    \___ \ / __/ _ \ / _ \| '_ \| | | |  _____  | |   | |    | | 
     ___) | (_| (_) | (_) | |_) | |_| | |_____| | |___| |___ | | 
    |____/ \___\___/ \___/|_.__/ \__, |          \____|_____|___|
                                 |___/                           
\r\n";
echo "Bem vindo ao Scooby CLI.
Você deseja criar um Model, um Controller ou um Arquivo? \r\n";
do {
    echo "
-----------------
|    OPTION:    |
---------------------------------------------------------------------
| DIGITE: 'New:DB' ou a palavra DataBase para criar um novo banco   |                                                 
| DIGITE: 'Migration' para criar uma migration                      |
| DIGITE: 'Migrate' para executar as migration criadas              |
| DIGITE: 'Rollback' para executar um Rollback na migration criada  |                                                            
| DIGITE: 'New:Seed' para criar uma Seed no Banco de dados          |
| DIGITE: 'Run:Seed' para executar uma Seed no Banco de dados       |                                                  
| DIGITE: 'C' ou a paravra controller para criar um Controller      |
| DIGITE: 'M' ou a palavra model para criar um Model                |
| DIGITE: 'v' ou a paravra View para criar uma View                 |
| DIGITE: 'F' ou a palavra File para criar um Arquivo               |
| DIGITE: 'r' ou a palavra Route para criar uma rota                |
| DIGITE: 'Clear:Cache para apagar os arquivos de cache do twig     |
| DIGITE: 'Make:Auth' para criar uma rotina de cadastro e login     | 
| DIGITE: 'Sair' para cancelar a operação                           |
---------------------------------------------------------------------\r\n";
    echo "Aguardando a opção escolhida... \r\n";
    $component = fgets(STDIN);
    $component = rtrim($component);
    if ($component == 'F' or
    $component == 'f' or
    $component == 'file' or
    $component == 'File' or
    $component == 'arquivo' or
    $component == 'Arquivo') {
        echo "Você optou por criar um Arquivo. \r\n";
        echo "Por favor, DIGITE a extensão do Arquivo a ser criado \r\n";
        $ext = fgets(STDIN);
        $ext = strtolower($ext);
        $ext = rtrim($ext);
        echo "Por favor, DIGITE o nome do Arquivo a ser criado \r\n";
        $name = fgets(STDIN);
        $name = strtolower($name);
        $name = rtrim($name);
        echo "Por favor, DIGITE o caminho do arquivo a ser criado \r\n";
        $path = fgets(STDIN);
        $path = rtrim($path);
        if (file_exists(__DIR__."/$path/$name.$ext")) {
            echo "ERROR: Arquivo já existente na pasta '$path'!\r\n";
            exit;
        }
        if ($ext == 'php') {
            $content = file_get_contents('Library/shell/templates/php_tpl/phpFile.tpl');
        } elseif ($ext == 'html') {
            $content = file_get_contents('Library/shell/templates/html_tpl/htmlFile.tpl');
        } elseif ($ext == 'css') {
            $content = file_get_contents('Library/shell/templates/css_tpl/cssFile.tpl');
        } elseif ($ext == 'txt') {
            $content = file_get_contents('Library/shell/templates/txt_tpl/txtFile.tpl');
        } elseif ($ext == 'js') {
            $content = file_get_contents('Library/shell/templates/js_tpl/jsFile.tpl');
        }
        $content = strtr($content, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen(__DIR__."/$path/$name.$ext", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "$name.$ext criado em '".__DIR__."/$path/' com sucesso. \r\n";
    } elseif ($component == 'C' or
$component == 'c' or
$component == 'Controller' or
$component == 'controller' or
$component == 'Controler' or
$component == 'controler') {
        echo "Você optou por criar um Controller. \r\n";
        echo "Por favor, DIGITE o nome do controller a ser criado \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        $name = $name."Controller";
        if (file_exists("App/Controllers/$name.php")) {
            echo "ERROR: Controller já existente na pasta 'App/Controllers'!\r\n";
            exit;
        }
        $content = file_get_contents('Library/shell/templates/php_tpl/controllerFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Controllers/$name.php", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "{$name} criado em 'App/Controllers' com sucesso. \r\n";
    } elseif ($component == 'M' or
$component == 'm' or
$component == 'Model' or
$component == 'model') {
        echo "Você optou por criar um Model. \r\n";
        echo "Por favor, DIGITE o nome do Model a ser criado \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        if (file_exists("App/Models/$name.php")) {
            echo "ERROR: Model já existente na pasta 'App/Models'!\r\n";
            exit;
        }
        $content = file_get_contents('Library/shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "$name criado em 'App/Models' com sucesso. \r\n";
    } elseif ($component == 'ROUTE' or
    $component == 'R' or
    $component == 'r' or
    $component == 'Route' or
    $component == 'route') {
        echo "Você optou por criar uma Rota. \r\n";
        echo "Por favor, DIGITE o novo caminho da Rota a ser criado / \r\n";
        $route = fgets(STDIN);
        $route = rtrim($route);
        echo "Por favor, DIGITE o padrão que a nova rota buscara começando com / \r\n";
        $partner = fgets(STDIN);
        $partner = rtrim($partner);
        $content = '$route["'.$route.'"] = "'.$partner.'";'.PHP_EOL;
        $f = fopen("Config/routes.php", 'a+');
        fwrite($f, $content);
        fclose($f);
        echo "Rota criada em 'Config/routes.php' com sucesso. \r\n";
    } elseif ($component == 'V' or
$component == 'v' or
$component == 'View' or
$component == 'view' or
$component ==   'VIEW') {
        echo "Você optou por criar uma View. \r\n";
        echo "Por favor, DIGITE o nome da View a ser criada \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        if (file_exists("App/Views/Pages/$name.twig")) {
            echo "ERROR: View já existente na pasta 'App/Views/Pages'!\r\n";
            exit;
        }
        $content = file_get_contents('Library/shell/templates/twig_tpl/viewFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Views/Pages/$name.twig", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "$name criado em 'App/Views/Pages' com sucesso. \r\n";
    } elseif ($component == 'NewDb' or
$component == 'newDb' or
$component == 'newdb' or
$component == 'NEWDB' or
$component == 'New:Db' or
$component == 'new:Db' or
$component == 'new:db' or
$component == 'NEW:DB' or
$component == 'database' or
$component == 'DataBase' or
$component == 'dataBase' or
$component == 'Database' or
$component == 'DATABASE'
) {
        echo "Você optou por criar um novo banco de dados. \r\n";
        $content = "";
        echo "Por favor, DIGITE o nome do Banco a ser criada \r\n";
        $name = fgets(STDIN);
        $name = rtrim($name);
        try {
            $conn = new PDO(DB_DRIVER.":host=".DB_HOST.";charset=utf8", DB_USER, DB_PASS,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        } catch (Exception $e) {
            echo "Um erro inesperado ocorreu, por favor tente mais tarde.";
            exit;
        }
        $test = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");
        if ($test->fetchColumn()) {
            echo "ERROR: Banco de dados já existente\r\n";
            exit;
        }
        $create = $conn->query("CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_general_ci;");
        if ($create) {
            echo "BANCO DE DADOS $name Criado com sucesso\r\n";
            $configDb = file_get_contents('Config/config.php');
            $configDb = strtr($configDb, [
                "'DB_NAME', ''" =>  "'DB_NAME', '$name'"
            ]);
            $f = fopen("Config/config.php", 'w+');
            fwrite($f, $configDb);
            fclose($f);
            echo "DB_NAME alterado com sucesso em Config/config.php\r\n";
        } else {
            echo "Um erro inesperado ocorreu, por favor tente mais tarde.";
        }
    } elseif ($component == 'clear:cache' or
    $component == 'Clear:Cache' or
    $component == 'CLEAR:CACHE' or
    $component == 'clearcache' or
    $component == 'clearCache' or
    $component == 'ClearCache' or
    $component == 'CLEARCACHE') {
        $cacheDir = scandir('Config/Cache/');
        if (count($cacheDir) > 2) {
            $clearCache = shell_exec('sudo rm -rf Config/Cache/*');
            echo 'Diretório de Cache limpo com suscesso \r\n';
        } else {
            echo 'Você não possui nenhum arquivo de cache disponivel para ser deletado. \r\n';
        }
    } elseif ($component == 'migration' or
$component == 'MIGRATION' or
$component == 'Migration') {
        echo "Por favor, DIGITE o nome da Migration a ser criada. Use o formato CamelCase \r\n";
        $migrationName = fgets(STDIN);
        $migrationName = ucfirst($migrationName);
        $migrationName = rtrim($migrationName);
        if (file_exists("db/migrations/$migrationName.php")) {
            echo "ERROR: Migration já existente na pasta 'db/migrations/'!\r\n";
            exit;
        }
        $migration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
        if (!$migration) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Migration $migrationName criada com sucesso em db/migrations/ \r\n";
    } elseif ($component == 'migrate' or
$component == 'MIGRATE' or
$component == 'Migrate') {
        $migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
        if (!$migrate) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Migrate executada com sucesso. \r\n";
    } elseif ($component == 'rollback' or
$component == 'ROLLBACK' or
$component == 'Rollback') {
        $rollback = shell_exec("php vendor/robmorgan/phinx/bin/phinx rollback");
        if (!$rollback) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Rollback executado com sucesso. \r\n";
    } elseif ($component == 'NewSeed' or
    $component == 'NEWSEED' or
    $component == 'newSeed'or
    $component == 'newseed' or
    $component == 'New:Seed' or
    $component == 'NEW:SEED' or
    $component == 'new:Seed'or
    $component == 'new:seed') {
        echo "Por favor, DIGITE o nome da Seed a ser criada. Use o formato CamelCase \r\n";
        $seedName = fgets(STDIN);
        $seedName = ucfirst($seedName);
        $seedName = rtrim($seedName);
        if (file_exists("db/seeds/$seedName.php")) {
            echo "ERROR: Seed já existente na pasta 'db/seeds/'!\r\n";
            exit;
        }
        $seed = file_get_contents('Library/shell/templates/seeds_tpl/seedFile.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("db/seeds/$seedName.php", 'w+');
        fwrite($f, $seed);
        fclose($f);
        echo "Seed {$seedName}Seed criada com sucesso em db/seeds/ \r\n";
    } elseif ($component == 'RunSeed' or
        $component == 'RUNSEED' or
        $component == 'runSeed'or
        $component == 'runseed' or
        $component == 'Run:Seed' or
        $component == 'RUN:SEED' or
        $component == 'run:Seed'or
        $component == 'run:seed') {
        echo "Por favor, DIGITE o nome da Seed a ser executada. Use o mesmo formato dado ao nome do arquivo \r\n";
        $seedName = fgets(STDIN);
        $seedName = ucfirst($seedName);
        $seedName = rtrim($seedName);
        chdir('db/seeds');
        shell_exec('php '.$seedName.'.php');

        echo "Seed {$seedName} executada com sucesso em db/seeds/ \r\n";
    } elseif ($component == 'MakeAuth' or
    $component == 'MAKEAUTH' or
    $component == 'makeAuth'or
    $component == 'makeauth' or
    $component == 'Make:Auth' or
    $component == 'MAKE:AUTH' or
    $component == 'make:Auth'or
    $component == 'make:auth') {
        $userController = file_get_contents('Library/shell/templates/php_tpl/userController.tpl');
        $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);
        $userModel = file_get_contents('Library/shell/templates/php_tpl/userModel.tpl');
        $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);
        $loginView = file_get_contents('Library/shell/templates/twig_tpl/login.tpl');
        $loginView = strtr($loginView, ['dateNow' => date('d-m-y - H:i:a')]);
        $registerView = file_get_contents('Library/shell/templates/twig_tpl/register.tpl');
        $registerView = strtr($registerView, ['dateNow' => date('d-m-y - H:i:a')]);
        $passwordRescue = file_get_contents('Library/shell/templates/twig_tpl/passwordRescue.tpl');
        $passwordRescue = strtr($passwordRescue, ['dateNow' => date('d-m-y - H:i:a')]);
        $dashBoardView = file_get_contents('Library/shell/templates/twig_tpl/dashboard.tpl');
        $dashBoardView = strtr($dashBoardView, ['dateNow' => date('d-m-y - H:i:a')]);
        $routesAuth = file_get_contents('Library/shell/templates/php_tpl/routesAuth.tpl');
        $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);
        $navbar = file_get_contents('Library/shell/templates/twig_tpl/navbar.tpl');
        $navbar = strtr($navbar, ['dateNow' => date('d-m-y - H:i:a')]);
        $authConfig = file_get_contents('Library/shell/templates/php_tpl/authConfig.tpl');
        if (file_exists("App/Controllers/UserController.php")) {
            echo "ERROR: Controller UserController já existente na pasta 'App/Controllers'!\r\n";
            exit;
        }
        if (file_exists("App/Models/User.php")) {
            echo "ERROR: Model User já existente na pasta 'App/Models'!\r\n";
            exit;
        }
        if (file_exists("App/Views/Pages/Login.twig")) {
            echo "ERROR: View Login já existente na pasta 'App/Views/Pages'!\r\n";
            exit;
        }
        if (file_exists("App/Views/Pages/Register.twig")) {
            echo "ERROR: View Register já existente na pasta 'App/Views/Pages'!\r\n";
            exit;
        }
        if (file_exists("App/Views/Pages/passwordRescue.twig")) {
            echo "ERROR: View Password Rescue já existente na pasta 'App/Views/Pages'!\r\n";
            exit;
        }
        $f = fopen("App/Controllers/UserController.php", 'w+');
        fwrite($f, $userController);
        fclose($f);
        echo "UserController criado em 'App/Controllers' com sucesso. \r\n";
        $f = fopen("App/Models/User.php", 'w+');
        fwrite($f, $userModel);
        fclose($f);
        echo "User criado em 'App/Models' com sucesso. \r\n";
        $f = fopen("App/Views/Pages/Login.twig", 'w+');
        fwrite($f, $loginView);
        fclose($f);
        echo "Login criado em 'App/Views/Pages' com sucesso. \r\n";
        $f = fopen("App/Views/Pages/Register.twig", 'w+');
        fwrite($f, $registerView);
        fclose($f);
        echo "Register criado em 'App/Views/Pages' com sucesso. \r\n";
        $f = fopen("App/Views/Pages/PasswordRescue.twig", 'w+');
        fwrite($f, $passwordRescue);
        fclose($f);
        echo "PasswordRescue criado em 'App/Views/Pages' com sucesso. \r\n";
        $f = fopen("App/Views/Pages/DashBoard.twig", 'w+');
        fwrite($f, $dashBoardView);
        fclose($f);
        echo "DashBoard criado em 'App/Views/Pages' com sucesso. \r\n";
        $f = fopen("Config/routes.php", 'a+');
        fwrite($f, $routesAuth);
        fclose($f);
        echo "Rotas de Autenticação criadas em 'Config/routes.php' com sucesso. \r\n";
        $f = fopen("App/Views/Pages/Home.twig", 'w+');
        fwrite($f, $navbar);
        fclose($f);
        echo "Navbar criado em 'App/Views/Pages/Home.twig' com sucesso. \r\n";
        $f = fopen("Config/authConfig.php", 'w+');
        fwrite($f, $authConfig);
        fclose($f);
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='Library/shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
        if ($migrationUser) {
            $migrate = shell_exec("php vendor/bin/phinx migrate");
            echo "Migration UserAuth criada com sucesso\r\n";
            echo "Migrate executada com sucesso\r\n";
        }
        $seed = file_get_contents('Library/shell/templates/seeds_tpl/SeedUserAuth.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("db/seeds/SeedUserAuth.php", 'w+');
        fwrite($f, $seed);
        fclose($f);
        echo "SeedUserAuth criada com sucesso em db/seeds/ \r\n";
    } elseif ($component == 's' or
          $component == 'S' or
          $component == 'sair' or $component == 'Sair') {
        echo "Operação cancelada pelo usuário!\r\n\r\n";
        exit;
    } else {
        echo "Opção inválida \r\n\r\n";
        exit;
    }
    echo "
Deseja continuar ?
DIGITE: 'Y' para continuar ou 'S' para sair\r\n";
    $component = fgets(STDIN);
    $component = rtrim($component);
} while ($component == 'y' or
         $component == 'Y' or
         $component == 'yes' or
         $component == 'YES' or
         $component == 'Yes');
if ($component == 's' or
          $component == 'S' or
          $component == 'sair' or $component == 'Sair') {
    echo "Operação cancelada pelo usuário!\r\n\r\n";
    exit;
} else {
    echo "Opção inválida \r\n\r\n";
    exit;
}
