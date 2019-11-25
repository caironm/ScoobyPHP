<?php
require_once 'vendor/autoload.php';
require_once 'Config/env.php';
require_once 'Config/config.php';
//require_once 'Library/Helpers/FlashMessage.php';

use Helpers\FlashMessage;

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    FlashMessage::modalWithGoBack('PARE', 'Esta é uma área restrita, o Scooby_CLI é reservado para se trabalhar em linha de comando. Você sera redirecionado!', 'error');
    die;
}

function showHeader()
{
    echo "\r\n
    ____                  _                      ____ _     ___ 
   / ___|  ___ ___   ___ | |__  _   _           / ___| |   |_ _|
   \___ \ / __/ _ \ / _ \| '_ \| | | |  _____  | |   | |    | | 
    ___) | (_| (_) | (_) | |_) | |_| | |_____| | |___| |___ | | 
   |____/ \___\___/ \___/|_.__/ \__, |          \____|_____|___|
                                |___/                           
    \r\n";
    echo "Bem vindo ao Scooby CLI.\r\n";
}

function showHeaderOption()
{
    echo "
-----------------
|    OPTION:    |
---------------------------------------------------------------------------------
| DIGITE: 'new:db' ou a palavra DataBase para criar um novo banco               |
| DIGITE: 'make:migration' para criar uma migration                             |
| DIGITE: 'migrate' para executar as migration criadas                          |
| DIGITE: 'Rollback' para executar um Rollback na migration criada              |
| DIGITE: 'make:seed' para criar uma Seed no Banco de dados                     |
| DIGITE: 'Run:Seed' para executar uma Seed no Banco de dados                   |
| DIGITE: 'make:controller' ou a paravra controller para criar um Controller    |
| DIGITE: 'make:controller -r' ou a paravra --resource para criar               |
| um ResourceController                                                         |
| DIGITE: 'make:model' ou a palavra model para criar um Model                   |
| DIGITE: 'make:model -m' ou a paravra --migration para criar                   |
| um model com uma respectiva migration                                         |
| DIGITE: 'make:model -m -s' ou a paravra --migration --seed para criar         |
| um model com uma respectiva migration e uma respectiva seed                   |
| DIGITE: 'make:view' para criar uma View                                       |
| DIGITE: 'make:file' para criar um Arquivo                                     |
| DIGITE: 'make:route' para criar uma rota                                      |
| DIGITE: 'Clear:Cache para apagar os arquivos de cache do twig                 |
| DIGITE: 'make:auth' para criar uma rotina de cadastro e login                 |
| DIGITE: 'y' Para continuar                                                    |
| DIGITE: 'N' para cancelar a operação                                          |
---------------------------------------------------------------------------------\r\n";
    echo "Aguardando a opção escolhida... \r\n";
}

function execOptionMakeFile()
{
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
    if (file_exists(__DIR__ . "/$path/$name.$ext")) {
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
    $f = fopen(__DIR__ . "/$path/$name.$ext", 'w+');
    fwrite($f, $content);
    fclose($f);
    echo "$name.$ext criado em '" . __DIR__ . "/$path/' com sucesso. \r\n";
}

function execOptionMakeController()
{
    echo "Você optou por criar um Controller. \r\n";
    echo "Por favor, DIGITE o nome do controller a ser criado \r\n";
    $name = fgets(STDIN);
    $name = ucfirst($name);
    $name = rtrim($name);
    $name = $name . "Controller";
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
}

function execOptionMakeControllerResource()
{
    echo "Você optou por criar um ResourceController. \r\n";
    echo "Por favor, DIGITE o nome do ResourceController a ser criado \r\n";
    $name = fgets(STDIN);
    $name = rtrim($name);
    $routeName = $name;
    $name = ucfirst($name);
    $name = $name . "Controller";
    if (file_exists("App/Controllers/$name.php")) {
        echo "ERROR: Controller já existente na pasta 'App/Controllers'!\r\n";
        exit;
    }
    $content = file_get_contents('Library/shell/templates/php_tpl/resourceControllerFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $routeResource = file_get_contents('Library/shell/templates/php_tpl/routesResourceFile.tpl');
    $routeResource = strtr($routeResource, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $routeName
    ]);
    $f = fopen("App/Controllers/$name.php", 'w+');
    fwrite($f, $content);
    fclose($f);
    echo "{$name} criado em 'App/Controllers' com sucesso. \r\n";
    $f = fopen("Config/routes.php", 'a+');
    fwrite($f, $routeResource);
    fclose($f);
    echo "Rotas do controller {$name} criadas em 'Config/routes' com sucesso. \r\n";
}

function execOptionMakeModel()
{
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
}

function execOptionMakeModelMigration()
{
    echo "Você optou por criar um Model. \r\n";
    echo "Por favor, DIGITE o nome do Model a ser criado \r\n";
    $name = fgets(STDIN);
    $name = rtrim($name);
    $name = ucfirst($name);
    $migrationName = $name . "CreateTable";
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
    if (file_exists("db/migrations/$migrationName.php")) {
        echo "ERROR: Migration já existente na pasta 'db/migrations/'!\r\n";
        exit;
    }
    $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
    if (!$modelMigration) {
        echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
        exit;
    }
}

function execOptionMakeModelMigrationAndSeed()
{
    echo "Você optou por criar um Model. \r\n";
    echo "Por favor, DIGITE o nome do Model a ser criado \r\n";
    $name = fgets(STDIN);
    $name = rtrim($name);
    $name = ucfirst($name);
    $migrationName = $name . "CreateTable";
    $seedName = $name . "Seed";
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
    if (file_exists("db/migrations/$migrationName.php")) {
        echo "ERROR: Migration já existente na pasta 'db/migrations/'!\r\n";
        exit;
    }
    $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
    if (!$modelMigration) {
        echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
        exit;
    }
    if (file_exists("db/seeds/$seedName.php")) {
        echo "ERROR: Seed já existente na pasta 'db/seeds/'!\r\n";
        exit;
    }
    $seed = file_get_contents('Library/shell/templates/seeds_tpl/seedFile.tpl');
    $seed = strtr($seed, [
        'dateNow' => date('d-m-y - H:i:a'),
        'users' => strtolower($name) . "s",
    ]);
    $f = fopen("db/seeds/$seedName.php", 'w+');
    fwrite($f, $seed);
    fclose($f);
    echo "Seed {$seedName}Seed criada com sucesso em db/seeds/ \r\n";
}

function execOptionMakeRoute()
{
    echo "Você optou por criar uma Rota. \r\n";
    echo "Por favor, DIGITE o novo caminho da Rota a ser criado / \r\n";
    $route = fgets(STDIN);
    $route = rtrim($route);
    echo "Por favor, DIGITE o padrão que a nova rota buscara começando com / \r\n";
    $partner = fgets(STDIN);
    $partner = rtrim($partner);
    $content = '$route["' . $route . '"] = "' . $partner . '";' . PHP_EOL;
    $f = fopen("Config/routes.php", 'a+');
    fwrite($f, $content);
    fclose($f);
    echo "Rota criada em 'Config/routes.php' com sucesso. \r\n";
}

function execOptionMakeView()
{
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
}

function execOptionMakeNewDb()
{
    echo "Você optou por criar um novo banco de dados. \r\n";
    $content = "";
    echo "Por favor, DIGITE o nome do Banco a ser criada \r\n";
    $name = fgets(STDIN);
    $name = rtrim($name);
    try {
        $conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
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
}

function execOptionMakeClearCache()
{
    $cacheDir = scandir('Config/Cache/');
    if (count($cacheDir) > 2) {
        $clearCache = shell_exec('sudo rm -rf Config/Cache/*');
        echo 'Diretório de Cache limpo com suscesso \r\n';
    } else {
        echo 'Você não possui nenhum arquivo de cache disponivel para ser deletado. \r\n';
    }
}

function execOptionMakeMigration()
{
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
}

function execOptionMakeSeed()
{
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
}

function execOptionMakeAuth()
{
    $userController = file_get_contents('Library/shell/templates/php_tpl/userController.tpl');
    $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

    $userModel = file_get_contents('Library/shell/templates/php_tpl/userModel.tpl');
    $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

    $passwordTokenModel = file_get_contents('Library/shell/templates/php_tpl/passwordRescueModel.tpl');
    $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

    $loginView = file_get_contents('Library/shell/templates/twig_tpl/login.tpl');
    $loginView = strtr($loginView, ['dateNow' => date('d-m-y - H:i:a')]);

    $registerView = file_get_contents('Library/shell/templates/twig_tpl/register.tpl');
    $registerView = strtr($registerView, ['dateNow' => date('d-m-y - H:i:a')]);

    $passwordRescue = file_get_contents('Library/shell/templates/twig_tpl/passwordRescue.tpl');
    $passwordRescue = strtr($passwordRescue, ['dateNow' => date('d-m-y - H:i:a')]);

    $newPassword = file_get_contents('Library/shell/templates/twig_tpl/newPassword.tpl');
    $newPassword = strtr($newPassword, ['dateNow' => date('d-m-y - H:i:a')]);

    $dashBoardView = file_get_contents('Library/shell/templates/twig_tpl/dashboard.tpl');
    $dashBoardView = strtr($dashBoardView, ['dateNow' => date('d-m-y - H:i:a')]);

    $updateUser = file_get_contents('Library/shell/templates/twig_tpl/updateUser.tpl');
    $updateUser = strtr($updateUser, ['dateNow' => date('d-m-y - H:i:a')]);

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
    if (file_exists("App/Views/Pages/NewPassword.twig")) {
        echo "ERROR: View New Password Rescue já existente na pasta 'App/Views/Pages'!\r\n";
        exit;
    }
    $f = fopen("App/Controllers/UserController.php", 'w+');
    fwrite($f, $userController);
    fclose($f);
    echo "UserController criado em 'App/Controllers' com sucesso. \r\n";
    $f = fopen("App/Models/User.php", 'w+');
    fwrite($f, $userModel);
    fclose($f);
    $f = fopen("App/Models/PasswordUserToken.php", 'w+');
    fwrite($f, $passwordTokenModel);
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
    $f = fopen("App/Views/Pages/NewPassword.twig", 'w+');
    fwrite($f, $newPassword);
    fclose($f);
    echo "PasswordRescue criado em 'App/Views/Pages' com sucesso. \r\n";
    $f = fopen("App/Views/Pages/DashBoard.twig", 'w+');
    fwrite($f, $dashBoardView);
    fclose($f);
    echo "DashBoard criado em 'App/Views/Pages' com sucesso. \r\n";
    $f = fopen("App/Views/Pages/UpdateUser.twig", 'w+');
    fwrite($f, $updateUser);
    fclose($f);
    echo "UpdateUser criado em 'App/Views/Pages' com sucesso. \r\n";
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
    $migrate = shell_exec("php vendor/bin/phinx migrate");
    sleep(1);
    $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='Library/shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
    $migrate = shell_exec("php vendor/bin/phinx migrate");
    if ($migrationUser) {
        echo "Migration UserAuth criada com sucesso\r\n";
        echo "Migrate executada com sucesso\r\n";
    }
    $seed = file_get_contents('Library/shell/templates/seeds_tpl/SeedUserAuth.tpl');
    $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
    $f = fopen("db/seeds/SeedUserAuth.php", 'w+');
    fwrite($f, $seed);
    fclose($f);
    echo "SeedUserAuth criada com sucesso em db/seeds/ \r\n";
}

$date = date('d-m-y - H:i:a');
showHeader();
do {
    showHeaderOption();
    $component = fgets(STDIN);
    $component = rtrim($component);
    $component = strtolower($component);
    if ($component == 'make:file' or $component == 'makefile') {
        execOptionMakeFile();
    } elseif ($component == 'make:controller' or $component == 'makecontroller') {
        execOptionMakeController();
    } elseif (
        $component == 'make:controller -r' or $component == 'makecontroller -r'
        or $component == 'make:controller --resource' or $component == 'makecontroller --resource'
    ) {
        execOptionMakeControllerResource();
    } elseif (
        $component == 'make:model' or
        $component == 'makemodel'
    ) {
        execOptionMakeModel();
    } elseif (
        $component == 'makemodel -m' or
        $component == 'make:model -m' or
        $component == 'makemodel --migration' or
        $component == 'make:model --migration'
    ) {
        execOptionMakeModelMigration();
    } elseif (
        $component == 'make:model -m -s' or
        $component == 'makemodel -m -s' or
        $component == 'make:model --migration --seed' or
        $component == 'makemodel --migration --seed'
    ) {
        execOptionMakeModelMigrationAndSeed();
    } elseif (
        $component == 'make:route' or
        $component == 'makeroute'
    ) {
        execOptionMakeRoute();
    } elseif (
        $component == 'make:view' or
        $component == 'makeview'
    ) {
        execOptionMakeView();
    } elseif (
        $component == 'newDb' or
        $component == 'new:Db'
    ) {
        execOptionMakeNewDb();
    } elseif (
        $component == 'clear:cache' or
        $component == 'clearCache'
    ) {
        execOptionMakeClearCache();
    } elseif (
        $component == 'make:migration' or
        $component == 'makemigration'
    ) {
        execOptionMakeMigration();
    } elseif (
        $component == 'migrate' or
        $component == 'MIGRATE' or
        $component == 'Migrate'
    ) {
        $migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
        if (!$migrate) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Migrate executada com sucesso. \r\n";
    } elseif (
        $component == 'rollback' or
        $component == 'ROLLBACK' or
        $component == 'Rollback'
    ) {
        $rollback = shell_exec("php vendor/robmorgan/phinx/bin/phinx rollback");
        if (!$rollback) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Rollback executado com sucesso. \r\n";
    } elseif (
        $component == 'makeseed' or
        $component == 'make:seed'
    ) {
        execOptionMakeSeed();
    } elseif (
        $component == 'runSeed' or
        $component == 'run:seed'
    ) {
        echo "Por favor, DIGITE o nome da Seed a ser executada. Use o mesmo formato dado ao nome do arquivo \r\n";
        $seedName = fgets(STDIN);
        $seedName = ucfirst($seedName);
        $seedName = rtrim($seedName);
        chdir('db/seeds');
        shell_exec('php ' . $seedName . '.php');

        echo "Seed {$seedName} executada com sucesso em db/seeds/ \r\n";
    } elseif (
        $component == 'makeauth' or
        $component == 'make:auth'
    ) {
        execOptionMakeAuth();
    } elseif (
        $component == 's' or
        $component == 'S' or
        $component == 'sair' or $component == 'Sair'
    ) {
        echo "Operação cancelada pelo usuário!\r\n\r\n";
        exit;
    } else {
        echo "Opção inválida \r\n\r\n";
        exit;
    }
    echo "
Deseja continuar ?
DIGITE: ['Y'] para continuar
DIGITE: ['N'] para sair\r\n";
    $component = fgets(STDIN);
    $component = rtrim($component);
} while (
    $component == 'y' or
    $component == 'Y' or
    $component == 'yes' or
    $component == 'YES' or
    $component == 'Yes'
);
if (
    $component == 'n' or
    $component == 'N' or
    $component == 'No' or $component == 'Sair'
) {
    echo "Operação cancelada pelo usuário!\r\n\r\n";
    exit;
} else {
    echo "Opção inválida \r\n\r\n";
    exit;
}
