<?php
require_once 'vendor/autoload.php';
require_once 'App/Config/env.php';
require_once 'App/Config/config.php';

use Scooby\Helpers\Cli;

function showHeader()
{
    Cli::println(PHP_EOL . "\033[1;90m
    ____                  _                      ____ _     ___ 
   / ___|  ___ ___   ___ | |__  _   _           / ___| |   |_ _|
   \___ \ / __/ _ \ / _ \| '_ \| | | |  _____  | |   | |    | | 
    ___) | (_| (_) | (_) | |_) | |_| | |_____| | |___| |___ | | 
   |____/ \___\___/ \___/|_.__/ \__, |          \____|_____|___|
                                |___/                           
    \033[1;97m");
}

function showHeaderOption()
{
    Cli::println("
    \033[1;32m *** Bem vindo ao Scooby CLI *** \033[1;97m
    \033[4;32m 
COMANDOS DISPONÍVEIS: \033[;97m

  \033[1;90m - DIGITE: \033[;97m 'new:db' para criar um novo banco
  \033[1;90m - DIGITE: \033[;97m 'make:migration' para criar uma migration
  \033[1;90m - DIGITE: \033[;97m 'migrate' para executar as migration criadas
  \033[1;90m - DIGITE: \033[;97m 'Rollback' para executar um Rollback na migration criada
  \033[1;90m - DIGITE: \033[;97m 'make:seed' para criar uma Seed no Banco de dados
  \033[1;90m - DIGITE: \033[;97m 'Run:Seed' para executar uma Seed no Banco de dados
  \033[1;90m - DIGITE: \033[;97m 'make:controller' para criar um Controller
  \033[1;90m - DIGITE: \033[;97m 'make:controller -r' ou make:controller --resource para criar um 
  ResourceController
  \033[1;90m - DIGITE: \033[;97m 'make:model' para criar um Model
  \033[1;90m - DIGITE: \033[;97m 'make:model -m' ou make:model --migration para criar um model 
  com uma respectiva migration
  \033[1;90m - DIGITE: \033[;97m 'make:model -m -s' make:model --migration --seed para criar 
  um model com uma respectiva migration e uma respectiva seed
  \033[1;90m - DIGITE: \033[;97m 'make:view' para criar uma View
  \033[1;90m - DIGITE: \033[;97m 'make:view -a' para criar uma View autenticada
  \033[1;90m - DIGITE: \033[;97m 'make:file' para criar um Arquivo
  \033[1;90m - DIGITE: \033[;97m 'Clear:Cache para apagar os arquivos de cache do twig
  \033[1;90m - DIGITE: \033[;97m 'make:auth' para criar uma rotina de cadastro e login
");
}

function execOptionMakeFile()
{
    Cli::println('Você optou por criar um Arquivo.');
    $ext = Cli::getParam('Por favor, DIGITE a extensão do Arquivo a ser criado');
    $ext = strtolower($ext);
    $name = Cli::getParam('Por favor, DIGITE o nome do Arquivo a ser criado');
    $name = strtolower($name);
    $path = Cli::getParam('Por favor, DIGITE o caminho do arquivo a ser criado');
    if (file_exists(__DIR__ . "/$path/$name.$ext")) {
        Cli::println("ERROR: Arquivo já existente na pasta '$path'");
        return;
    }
    $content = null;
    if ($ext == 'php') {
        $content = file_get_contents('System/shell/templates/php_tpl/phpFile.tpl');
    } elseif ($ext == 'html') {
        $content = file_get_contents('System/shell/templates/html_tpl/htmlFile.tpl');
    } elseif ($ext == 'css') {
        $content = file_get_contents('System/shell/templates/css_tpl/cssFile.tpl');
    } elseif ($ext == 'txt') {
        $content = file_get_contents('System/shell/templates/txt_tpl/txtFile.tpl');
    } elseif ($ext == 'js') {
        $content = file_get_contents('System/shell/templates/js_tpl/jsFile.tpl');
    }
    $content = strtr((string) $content, ['dateNow' => date('d-m-y - H:i:a')]);
    $f = fopen("$path/$name.$ext", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name.$ext criado em '$path/' com sucesso.");
}

function execOptionMakeController()
{
    Cli::println("Você optou por criar um Controller.");
    $name = Cli::getParam('Por favor, DIGITE o nome do controller a ser criado');
    $name = ucfirst($name);
    $name = $name . "Controller";
    if (file_exists("App/Controllers/$name.php")) {
        Cli::println("ERROR: Controller já existente na pasta 'App/Controllers'");
        return;
    }
    $content = file_get_contents('System/shell/templates/php_tpl/controllerFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $f = fopen("App/Controllers/$name.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("{$name} criado em 'App/Controllers' com sucesso.");
}

function execOptionMakeControllerResource()
{
    Cli::println("Você optou por criar um ResourceController.");
    $name = Cli::getParam('Por favor, DIGITE o nome do ResourceController a ser criado');
    $routeName = $name;
    $name = ucfirst($name);
    $name = $name . "Controller";
    if (file_exists("App/Controllers/$name.php")) {
        Cli::println("ERROR: Controller já existente na pasta 'App/Controllers'");
        return;
    }
    $content = file_get_contents('System/shell/templates/php_tpl/resourceControllerFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $routeResource = file_get_contents('System/shell/templates/php_tpl/routesResourceFile.tpl');
    $routeResource = strtr($routeResource, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name,
        '$routeName' => $routeName
    ]);
    $f = fopen("App/Controllers/$name.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("{$name} criado em 'App/Controllers' com sucesso.");
    $f = fopen("App/Routes/routes.php", 'a+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $routeResource);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Rotas do controller {$name} criadas em 'App/Config/routes' com sucesso.");
}

function execOptionMakeModel()
{
    Cli::println("Você optou por criar um Model.");
    $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
    $name = ucfirst($name);
    if (file_exists("App/Models/$name.php")) {
        Cli::println("ERROR: Model já existente na pasta 'App/Models'");
        return;
    }
    $content = file_get_contents('System/shell/templates/php_tpl/modelFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $f = fopen("App/Models/$name.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name criado em 'App/Models' com sucesso.");
}

function execOptionMakeModelMigration()
{
    Cli::println("Você optou por criar um Model.");
    $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
    $name = ucfirst($name);
    $migrationName = $name . "CreateTable";
    if (file_exists("App/Models/$name.php")) {
        Cli::println("ERROR: Model já existente na pasta 'App/Models'");
        return;
    }
    $content = file_get_contents('System/shell/templates/php_tpl/modelFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $f = fopen("App/Models/$name.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name criado em 'App/Models' com sucesso.");
    if (file_exists("App/db/migrations/$migrationName.php")) {
        Cli::println("ERROR: Migration já existente na pasta 'App/db/migrations/'");
        return;
    }
    $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
    if (!$modelMigration) {
        Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
        return;
    }
}

function execOptionMakeModelMigrationAndSeed()
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
    $content = file_get_contents('System/shell/templates/php_tpl/modelFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $f = fopen("App/Models/$name.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name criado em 'App/Models' com sucesso.");
    if (file_exists("App/db/migrations/$migrationName.php")) {
        Cli::println("ERROR: Migration já existente na pasta 'App/db/migrations/'");
        return;
    }
    $modelMigration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
    if (!$modelMigration) {
        Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
        return;
    }
    if (file_exists("App/db/seeds/$seedName.php")) {
        Cli::println("ERROR: Seed já existente na pasta 'App/db/seeds/'");
        return;
    }
    $seed = file_get_contents('System/shell/templates/seeds_tpl/seedFile.tpl');
    $seed = strtr($seed, [
        'dateNow' => date('d-m-y - H:i:a'),
        'users' => strtolower($name) . "s",
    ]);
    $f = fopen("App/db/seeds/$seedName.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $seed);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Seed {$seedName}Seed criada com sucesso em App/db/seeds/");
}

function execOptionMakeView()
{
    Cli::println("Você optou por criar uma View.");
    $name = Cli::getParam('Por favor, DIGITE o nome da View a ser criada');
    $name = ucfirst($name);
    if (file_exists("App/Views/Pages/$name.twig")) {
        Cli::println("ERROR: View já existente na pasta 'App/Views/Pages'");
        return;
    }
    $content = file_get_contents('System/shell/templates/twig_tpl/viewFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $register = file_get_contents('App/Config/authConfig.php');
    $register = strtr($register, [
        '$notAutentication = [' => '$notAutentication = [
    ' . "'$name'" . ','
    ]);
    $f = fopen("App/Views/Pages/$name.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    $f = fopen('App/Config/authConfig.php', 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $register);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name criado em 'App/Views/Pages' com sucesso.");
}

function execOptionMakeViewAuth()
{
    Cli::println("Você optou por criar uma View.");
    $name = Cli::getParam('Por favor, DIGITE o nome da View a ser criada');
    $name = ucfirst($name);
    if (file_exists("App/Views/Pages/$name.twig")) {
        Cli::println("ERROR: View já existente na pasta 'App/Views/Pages'");
        return;
    }
    $content = file_get_contents('System/shell/templates/twig_tpl/viewFile.tpl');
    $content = strtr($content, [
        'dateNow' => date('d-m-y - H:i:a'),
        '$name' => $name
    ]);
    $register = file_get_contents('App/Config/authConfig.php');
    $register = strtr($register, [
        '$autentication = [' => '$autentication = [
    ' . "'$name'" . ','
    ]);
    $f = fopen("App/Views/Pages/$name.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $content);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    $f = fopen('App/Config/authConfig.php', 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $register);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("$name criado em 'App/Views/Pages' com sucesso.");
}

function execOptionMakeNewDb()
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
            $connectionUpdate = file_get_contents('App/Config/config.php');
            $connectionUpdate = strtr($connectionUpdate, [
                "'DB_NAME', ''" =>  "'DB_NAME', '$name'",
                "'DB_USER', 'root'" =>  "'DB_USER', '$dbUser'",
                "'DB_PASS', ''" =>  "'DB_PASS', '$dbpass'"
            ]);
            $f = fopen("App/Config/config.php", 'w+');
            if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
            fwrite($f, $connectionUpdate);
            if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
            fclose($f);
            Cli::println('Banco de dados ' . $name . ' conectado com sucesso em App/Config/config.php');
        } else {
            Cli::println('Operação cancelada pelo usuário');
            return;
        }
    }
    $create = $conn->query("CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_general_ci;");
    if ($create) {
        Cli::println("BANCO DE DADOS $name Criado com sucess");
        $configDb = file_get_contents('App/Config/config.php');
        $configDb = strtr($configDb, [
            "'DB_NAME', ''" =>  "'DB_NAME', '$name'"
        ]);
        $f = fopen("App/Config/config.php", 'w+');
        if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
        fwrite($f, $configDb);
        if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
        fclose($f);
        Cli::println('DB_NAME alterado com sucesso em App/Config/config.php');
    } else {
        Cli::println("Um erro inesperado ocorreu, por favor tente mais tarde.");
    }
}

function execOptionMakeClearCache()
{
    $cacheDir = scandir('System/SysConfig/Cache/');
    if($cacheDir == false){
        Cli::println('Um erro desconhecido ocorreu ao limpar o cache da aplicação');
        return;
    }
    if (count($cacheDir) > 2) {
        $clearCache = shell_exec('sudo rm -rf System/SysConfig/Cache/*');
        Cli::println('Diretório de Cache limpo com suscesso');
    } else {
        Cli::println('Você não possui nenhum arquivo de cache disponivel para ser deletado.');
    }
}

function execOptionMakeMigration()
{
    $migrationName = Cli::getParam('Por favor, DIGITE o nome da Migration a ser criada. Use o formato CamelCase');
    $migrationName = ucfirst($migrationName);
    if (file_exists("App/db/migrations/$migrationName.php")) {
        Cli::println("ERROR: Migration já existente na pasta 'App/db/migrations/'");
        return;
    }

    $migration = shell_exec("php vendor/robmorgan/phinx/bin/phinx create $migrationName");
    if (!$migration) {
        Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
        return;
    }
    Cli::println("Migration $migrationName criada com sucesso em App/db/migrations/");
}

function execOptionMakeSeed()
{
    $seedName = Cli::getParam('Por favor, DIGITE o nome da Seed a ser criada. Use o formato CamelCase');
    $seedName = ucfirst($seedName);
    if (file_exists("App/db/seeds/$seedName.php")) {
        Cli::println("ERROR: Seed já existente na pasta 'App/db/seeds/'");
        return;
    }
    $seed = file_get_contents('System/shell/templates/seeds_tpl/seedFile.tpl');
    $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
    $f = fopen("App/db/seeds/$seedName.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $seed);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Seed {$seedName}Seed criada com sucesso em App/db/seeds/");
}

function execOptionMakeAuth()
{
    Cli::println('Por favor digite sua senha para dar permissão de escrita no cache da aplicação');
    shell_exec('sudo chmod 777 -R System/SysConfig/Cache');
    $userController = file_get_contents('System/shell/templates/php_tpl/userController.tpl');
    $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

    $dashboardController = file_get_contents('System/shell/templates/php_tpl/dashboardController.tpl');
    $dashboardController = strtr($dashboardController, ['dateNow' => date('d-m-y - H:i:a')]);


    $userModel = file_get_contents('System/shell/templates/php_tpl/userModel.tpl');
    $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

    $passwordTokenModel = file_get_contents('System/shell/templates/php_tpl/passwordRescueModel.tpl');
    $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

    $loginView = file_get_contents('System/shell/templates/twig_tpl/login.tpl');
    $loginView = strtr($loginView, ['dateNow' => date('d-m-y - H:i:a')]);

    $registerView = file_get_contents('System/shell/templates/twig_tpl/register.tpl');
    $registerView = strtr($registerView, ['dateNow' => date('d-m-y - H:i:a')]);

    $passwordRescue = file_get_contents('System/shell/templates/twig_tpl/passwordRescue.tpl');
    $passwordRescue = strtr($passwordRescue, ['dateNow' => date('d-m-y - H:i:a')]);

    $newPassword = file_get_contents('System/shell/templates/twig_tpl/newPassword.tpl');
    $newPassword = strtr($newPassword, ['dateNow' => date('d-m-y - H:i:a')]);

    $dashBoardView = file_get_contents('System/shell/templates/twig_tpl/dashboard.tpl');
    $dashBoardView = strtr($dashBoardView, ['dateNow' => date('d-m-y - H:i:a')]);

    $updateUser = file_get_contents('System/shell/templates/twig_tpl/updateUser.tpl');
    $updateUser = strtr($updateUser, ['dateNow' => date('d-m-y - H:i:a')]);

    $routesAuth = file_get_contents('System/shell/templates/php_tpl/routesAuth.tpl');
    $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);

    $navbar = file_get_contents('System/shell/templates/twig_tpl/navbar.tpl');
    $navbar = strtr($navbar, ['dateNow' => date('d-m-y - H:i:a')]);

    $authConfig = file_get_contents('System/shell/templates/php_tpl/authConfig.tpl');

    if (file_exists("App/Controllers/UserController.php")) {
        Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
        return;
    }
    if (file_exists("App/Controllers/DashboardController.php")) {
        Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
        return;
    }
    if (file_exists("App/Models/User.php")) {
        Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
        return;
    }
    if (file_exists("App/Views/Pages/Login.twig")) {
        Cli::println("ERROR: View Login já existente na pasta 'App/Views/Pages'");
        return;
    }
    if (file_exists("App/Views/Pages/Register.twig")) {
        Cli::println("ERROR: View Register já existente na pasta 'App/Views/Pages'");
        return;
    }
    if (file_exists("App/Views/Pages/passwordRescue.twig")) {
        Cli::println("ERROR: View Password Rescue já existente na pasta 'App/Views/Pages'");
        return;
    }
    if (file_exists("App/Views/Pages/NewPassword.twig")) {
        Cli::println("ERROR: View New Password Rescue já existente na pasta 'App/Views/Pages'");
        return;
    }
    $f = fopen("App/Controllers/UserController.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $userController);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("UserController criado em 'App/Controllers' com sucesso.");
    $f = fopen("App/Controllers/DashboardController.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $dashboardController);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("UserController criado em 'App/Controllers' com sucesso.");
    $f = fopen("App/Models/User.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $userModel);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    $f = fopen("App/Models/PasswordUserToken.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $passwordTokenModel);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("User criado em 'App/Models' com sucesso.");
    $f = fopen("App/Views/Pages/Login.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $loginView);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Login criado em 'App/Views/Pages' com sucesso.");
    $f = fopen("App/Views/Pages/Register.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $registerView);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Register criado em 'App/Views/Pages' com sucesso.");
    $f = fopen("App/Views/Pages/PasswordRescue.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $passwordRescue);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    $f = fopen("App/Views/Pages/NewPassword.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $newPassword);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("PasswordRescue criado em 'App/Views/Pages' com sucesso.");
    $f = fopen("App/Views/Pages/DashBoard.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $dashBoardView);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("DashBoard criado em 'App/Views/Pages' com sucesso.");
    $f = fopen("App/Views/Pages/UpdateUser.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $updateUser);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("UpdateUser criado em 'App/Views/Pages' com sucesso.");
    $f = fopen("App/Routes/routes.php", 'a+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $routesAuth);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Rotas de Autenticação criadas em 'App/Routes/routes.php' com sucesso.");
    $f = fopen("App/Views/Pages/Home.twig", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $navbar);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("Navbar criado em 'App/Views/Pages/Home.twig' com sucesso.");
    $f = fopen("App/Config/authConfig.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $authConfig);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='System/shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
    $migrate = shell_exec("php vendor/bin/phinx migrate");
    sleep(1);
    $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='System/shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
    $migrate = shell_exec("php vendor/bin/phinx migrate");
    if ($migrationUser) {
        Cli::println("Migration UserAuth criada com sucess");
        Cli::println("Migrate executada com sucess");
    }
    $seed = file_get_contents('System/shell/templates/seeds_tpl/SeedUserAuth.tpl');
    $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
    $f = fopen("App/db/seeds/SeedUserAuth.php", 'w+');
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fwrite($f, $seed);
    if($f == false){
        Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
        return;
    }
    fclose($f);
    Cli::println("SeedUserAuth criada com sucesso em App/db/seeds/");
}

$date = date('d-m-y - //H:i:a');
showHeader();
do {
    showHeaderOption();
    $component = Cli::getParam("\033[1;32m Aguardando a opção escolhida... \033[1;97m");
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
        $component == 'make:view' or
        $component == 'makeview'
    ) {
        execOptionMakeView();
    } elseif (
        $component == 'make:view -a' or
        $component == 'makeview -a'
    ) {
        execOptionMakeViewAuth();
    } elseif (
        $component == 'newdb' or
        $component == 'new:db'
    ) {
        execOptionMakeNewDb();
    } elseif (
        $component == 'clear:cache' or
        $component == 'clearcache'
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
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }
        Cli::println("Migrate executada com sucesso.");
    } elseif (
        $component == 'rollback' or
        $component == 'ROLLBACK' or
        $component == 'Rollback'
    ) {
        $rollback = shell_exec("php vendor/robmorgan/phinx/bin/phinx rollback");
        if (!$rollback) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            return;
        }
        Cli::println("Rollback executado com sucesso.");
    } elseif (
        $component == 'makeseed' or
        $component == 'make:seed'
    ) {
        execOptionMakeSeed();
    } elseif (
        $component == 'runSeed' or
        $component == 'run:seed'
    ) {
        $seedName = Cli::getParam('Por favor, DIGITE o nome da Seed a ser executada. Use o mesmo formato dado ao nome do arquivo');
        $seedName = ucfirst($seedName);
        chdir('App/db/seeds');
        shell_exec('php ' . $seedName . '.php');

        Cli::println("Seed {$seedName} executada com sucesso em App/db/seeds/");
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
        Cli::println("\033[1;91m Operação cancelada pelo usuário! \033[1;97m");
        return;
    } else {
        Cli::println("\033[1;91m Opção inválida \033[1;97m");
        return;
    }
    Cli::println(
        "
        ----------------------------------------
        |          DESEJA CONTINUAR ?          |
        |--------------------------------------|
        | DIGITE: 'Y' Para continuar           |
        | DIGITE: 'N' para cancelar a operação |
        ----------------------------------------
        "
    );
    $component = Cli::getParam(
       " \033[1;32m Digite a opção desejada \033[1;97m" 
    );
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
    Cli::println("\033[1;91m Operação cancelada pelo usuário! \033[1;97m");
    return;
} else {
    Cli::println("\033[1;91m Opção inválida \033[1;97m");
    return;
}
