<?php

error_reporting(E_ALL);
require_once 'vendor/autoload.php';

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
        $content = "";
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
            $content = "<?php".PHP_EOL;
            $content .= "//Arquivo criado em ".date('d-m-y - H:i:a')." - Via Scooby-CLI.".PHP_EOL.PHP_EOL;
        } elseif ($ext == 'html') {
            $content = <<<HTML
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body>
        <!-- Arquivo criado em '.$date.' Via Scooby_CLI-->

        </body>
        </html>
HTML;
        } elseif ($ext == 'css') {
            $content = '
        /*
        * Arquivo criado em '.$date.' via Scooby_CLI
        */
        ';
        } elseif ($ext == 'txt') {
            $content = '
        # Arquivo criado em '.$date.' via Scooby_CLI
        ';
        } elseif ($ext == 'js') {
            $content = '
        // Arquivo criado em '.$date.' via Scooby_CLI
        ';
        }
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
        $content = "";
        echo "Por favor, DIGITE o nome do controller a ser criado \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        $name = $name."Controller";
        if (file_exists("App/Controllers/$name.php")) {
            echo "ERROR: Controller já existente na pasta 'App/Controllers'!\r\n";
            exit;
        }
        $content .= "<?php".PHP_EOL;
        $content .= "//Controller criado em ".date('d-m-y - H:i:a')." - Via Scooby-CLI.".PHP_EOL.PHP_EOL;
        $content .= "namespace Controllers;".PHP_EOL.PHP_EOL;
        $content .= "use \Core\Controller;".PHP_EOL.PHP_EOL;
        $content .= "class $name extends Controller".PHP_EOL;
        $content .= "{".PHP_EOL;
        $content .= "   public function index()".PHP_EOL;
        $content .= "   {".PHP_EOL;
        $content .= '       //$this->Load("Pages", "Home", []);'.PHP_EOL;
        $content .= "   }".PHP_EOL;
        $content .= "}".PHP_EOL;
        $f = fopen("App/Controllers/$name.php", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "{$name} criado em 'App/Controllers' com sucesso. \r\n";
    } elseif ($component == 'M' or
$component == 'm' or
$component == 'Model' or
$component == 'model') {
        echo "Você optou por criar um Model. \r\n";
        $content = "";
        echo "Por favor, DIGITE o nome do Model a ser criado \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        if (file_exists("App/Models/$name.php")) {
            echo "ERROR: Model já existente na pasta 'App/Models'!\r\n";
            exit;
        }
        $content .= "<?php".PHP_EOL;
        $content .= "//Model criado em ".date('d-m-y - H:i:a')." - Via Scooby-CLI.".PHP_EOL;
        $content .= "namespace Models;".PHP_EOL.PHP_EOL;
        $content .= "use \Core\Model;".PHP_EOL;
        $content .= "use Illuminate\Database\Capsule\Manager as db;".PHP_EOL.PHP_EOL;
        $content .= "class $name extends Model".PHP_EOL;
        $content .= "{".PHP_EOL.PHP_EOL;
        $content .= "}".PHP_EOL;
        $f = fopen("App/Models/$name.php", 'w+');
        fwrite($f, $content);
        fclose($f);
        echo "$name criado em 'App/Models' com sucesso. \r\n";
    } elseif ($component == 'M' or
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
$component == 'view') {
        echo "Você optou por criar uma View. \r\n";
        $content = "";
        echo "Por favor, DIGITE o nome da View a ser criada \r\n";
        $name = fgets(STDIN);
        $name = ucfirst($name);
        $name = rtrim($name);
        if (file_exists("App/Views/Pages/$name.twig")) {
            echo "ERROR: View já existente na pasta 'App/Views/Pages'!\r\n";
            exit;
        }
        $content .= "
<div id='$name'>
    <div class='container'>
        {# View criada em '.$date.' Via Scooby_CLI #}

    </div>
</div>
";
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
            $conn = new mysqli("127.0.0.1", "root", "");
        } catch (Exception $e) {
            echo "Um erro inesperado ocorreu, por favor tente mais tarde.";
            exit;
        }
        if (mysqli_select_db($conn, $name)) {
            echo "ERROR: Banco de dados já existente";
            exit;
        }
        $create = $conn->query("CREATE DATABASE IF NOT EXISTS $name;");
        if ($create) {
            echo "BANCO DE DADOS $name Criado com sucesso";
        } else {
            echo "Um erro inesperado ocorreu, por favor tente mais tarde.";
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
        $seed = shell_exec("php vendor/robmorgan/phinx/bin/phinx seed:create {$seedName}");
        if (!$seed) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
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
        $seedRun = shell_exec("php vendor/robmorgan/phinx/bin/phinx seed:run -s {$seedName}");
        if (!$seedRun) {
            echo "Ocorreu um erro inesperado, por favor tente novamente. \r\n";
            exit;
        }
        echo "Seed {$seedName} criada com sucesso em db/seeds/ \r\n";
    } elseif ($component == 'MakeAuth' or
    $component == 'MAKEAUTH' or
    $component == 'makeAuth'or
    $component == 'makeauth' or
    $component == 'Make:Auth' or
    $component == 'MAKE:AUTH' or
    $component == 'make:Auth'or
    $component == 'make:auth') {
        $userController =
'<?php

//Controller de autenticação criado automaticamente em '.date("d-m-y - H:i:a").' - Via Scooby-CLI

namespace Controllers;

use \Core\Controller;
use Helpers\FlashMessage;
use Helpers\Login;
use Helpers\Redirect;
use Helpers\Request;
use Helpers\Validation;
use Models\User;

class UserController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
        $this->Load("pages", "login");
    }

    /**
     * Recupera os valores de login digitados pelo usuario e efetua o login
     *
     * @return void
     */
    public function login()
    {
            $email =  Request::input("email");
            $pass =  Request::input("pass");
            if(Login::loginValidate($email, $pass, "users", "email", "password", "id")){
                $this->Load("pages", "DashBoard");
            }else{
                $this->Load("pages", "login", [
                    "msg" => FlashMessage::msg("Opss", "Falha na autenticação, por favor tente novamente.", "error")
                ]);
            }
    }

    /**
     * Carrega a view de cadastro de usuario
     *
     * @return void
     */
    public function register()
    {
        $this->Load("pages", "register");
    }

    /**
     * Adiciona um novo usuario no banco de dados
     *
     * @return void
     */
    public function saveUser()
    {   
            $name = Request::input("name");
            $email = Request::input("email");
            $pass = Login::passwordHash(Request::input("pass"));
            if(Validation::emailMatch($email, "users", "email")){
                $user = new User;
                $user->name = $name;
                $user->email= $email;
                $user->password = $pass; 
                if($user->save()){
                    $this->Load("pages", "login", [
                        "msg" => FlashMessage::msg("Tudo Certo...", "Usuário cadastrado com sucesso.", "success")
                    ]);
                }else{
                    $this->Load("pages", "Register", [
                        "msg" => FlashMessage::msg("Opss...", "Algo saiu errado, por favor tente mais tarde.", "error")
                    ]);
                }
            }else{
                $this->Load("pages", "register", [
                    "msg" => FlashMessage::msg("Opss...", "Email já cadastrado, por favor tente com um email diferente", "warning")
                ]);
            }
    }

    /**
     * Faz o logout do usuario
     *
     * @return void
     */
    public function exit()
    {
        Login::sessionLoginDestroyWithRedirect("login");
    }
}';
        $userModel =
'<?php

//Model de autenticação criado automaticamente em '.date("d-m-y - H:i:a").' - Via Scooby-CLI

namespace Models;

use \Core\Model;
use Illuminate\Database\Capsule\Manager as db;
use \Helpers\Helper;

class User extends Model
{
    //
}
';
        $loginView = <<<HTML
    {# View criada em '.$date.' Via Scooby_CLI #}
<div class="bg-login">
    <div class="container-fluid">
        <h2 class="center white-text">ScoobYTasks - Login</h2>
        {% if msg %}
        <span class="alert"> {{ msg|raw }} </span>
        {% endif %}
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <form class="login-form  z-depth-5" method="post" action="{{ base_url }}user/login">
                    <div class="card">
                        <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                        <div class="card-content">
                            <div class="input-field">
                                <input class="validate" id="email" type="email" name="email">
                                <label for="email">Email</label>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="input-field">
                                        <input id="password" type="password" name="pass">
                                        <label for="password">Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col s4">
                        <a href="{{ base_url }}user/register" class="btn purple">Registrar</a>
                    </div>
                    <div class="col s8 right-align">
                        <a href="#" class="btn red">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
        $registerView = <<<HTML
{# View criada em '.$date.' Via Scooby_CLI #}
<div class="container-fluid bg-login">
    <h3 class="center white-text">ScoobYTasks - Novo Usuário</h3>
    {% if msg %}
    <span class="alert center">{{ msg|raw }}</span>
    {% endif %}
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <form class="login-form  z-depth-5" method="post" action="{{ base_url }}user/saveUser">
                <div class="card">
                    <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                    <div class="card-content">
                        <div class="input-field">
                            <input class="validate" id="name" type="text" name="name">
                            <label for="name">Nome</label>
                        </div>
                        <div class="input-field">
                            <input class="validate" id="email" type="email" name="email">
                            <label for="email">Email</label>
                        </div>

                        <div class="row">
                            <div class="col s12 m8 l12">
                                <div class="input-field">
                                    <input id="password" type="password" name="pass">
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Criar Conta
                                <i class="material-icons right">send</i>
                            </button> </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s4">
                    <a href="{{ base_url }}user/index" class="btn purple">Login</a>
                </div>
                <div class="col s8 right-align">
                    <a href="#" class="btn red">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
        $passwordRescue = <<<HTML
Codigo de recuperação de usuario.
HTML;
        $dashBoardView = <<<HTML
<div class='container'>
    <a href='{{ base_url }}exit' class='btn red waves-light'>Sair</a>
<h3 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou corretamente!</h3>
</div>
HTML;
        $routesAuth =
'
//Rotas de autenticação criadas automaticamente em '.date('d-m-y - H:i:a').' com Scooby_CLI

$route["/login"] = "/user/index";
$route["/register"] = "/user/register";
$route["/passwordRescue"] = "/user/passwordRescue";
$route["/exit"] = "/user/exit";

';
        $navbar = <<<HTML
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="{{ base_url }}login" class="btn green waves-light">Entrar</a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="{{ base_url }}login" class="btn green waves-light">Entrar</a></li>
        </ul>
    </div>
    <div id="home">
    <div class="container">
        <h2 class="center">
            <b>ScoobY Framework</b>
        </h2>
        <h3>
            {{ wellcomeMessage }}
        </h3>
        <footer class="">
            <span class="right footer-msg"> Feito em <i class="green-text"><strong>PG</strong></i> com muito <i
                    class="material-icons right red-text">favorite</i></span>
        </footer>
    </div>
</div>    
HTML;
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
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth");
        if ($migrationUser) {
            echo '\r\n Migration User criada com sucesso, por favor preencha os dados em db/migration com:

            $this->table("table")
            ->addCollum("name", "string", ["null" => false])
            ->addCollum("email", "string", ["null" => false])
            ->addCollum("password", "string", ["null" => false])
            ->create();

            Apos a preencher a migration não esquecer de rodar o comando migrate passando CreateUserAuth
            ';
        }
        $seedUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx seed:create SeedUserAuth");
        if ($seedUser) {
            echo '\r\n SeedUserAuth criada com sucesso, por favor preencha os dados em db/seeds com:
                
                "name"          => $faker->name,
                "email"         => $faker->email,
                "password"      => \Helpers\Login::passwordHash($faker->password)


            Apos a preencher a UserSeed não esquecer de rodar o comando Run:Seed -s SeedUserAuth 
            ';
        }
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
DIGITE: 'OK' para continuar ou
DIGITE: 's' para sair
\r\n";
    $component = fgets(STDIN);
    $component = rtrim($component);
} while ($component == 'ok' or $component == 'OK' or $component == 'Ok');
if ($component == 's' or
          $component == 'S' or
          $component == 'sair' or $component == 'Sair') {
    echo "Operação cancelada pelo usuário!\r\n\r\n";
    exit;
} else {
    echo "Opção inválida \r\n\r\n";
    exit;
}
