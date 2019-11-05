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
----------------------------------------------------------------
| DIGITE: 'NewDB' ou a palavra DataBase para criar um novo     |
| banco de dados                                               |
| DIGITE: 'Migration' para criar uma migration                 |
| DIGITE: 'Migrate' para executar as migration criadas         |
| DIGITE: 'Rollback' para executar um Rollback na migration    |
| criada                                                       |
| DIGITE: 'NewSeed' para criar uma Seed no Banco de dados      |
| DIGITE: 'RunSeed' para executar uma Seed no Banco de dados   |                                                  |
| DIGITE: 'C' ou a paravra controller para criar um Controller |
| DIGITE: 'M' ou a palavra model para criar um Model           |
| DIGITE: 'v' ou a paravra View para criar uma View            |
| DIGITE: 'F' ou a palavra File para criar um Arquivo          | 
| DIGITE: 'Sair' para cancelar a operação                      |
----------------------------------------------------------------\r\n";
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
            $content = '
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
        '.PHP_EOL;
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
    $component == 'newseed') {
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
        $component == 'runseed') {
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
