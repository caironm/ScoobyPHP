<?php

error_reporting(E_ALL);

echo "\r\n
     ____                  _                      ____ _     ___ 
    / ___|  ___ ___   ___ | |__  _   _           / ___| |   |_ _|
    \___ \ / __/ _ \ / _ \| '_ \| | | |  _____  | |   | |    | | 
     ___) | (_| (_) | (_) | |_) | |_| | |_____| | |___| |___ | | 
    |____/ \___\___/ \___/|_.__/ \__, |          \____|_____|___|
                                 |___/                           
\r\n";
echo "Bem vindo ao Scooby CLI.
Você deseja criar um Model, um Controller ou um Banco de dados? \r\n";
echo "
-----------------
|    OPTION:    |
----------------------------------------------------------------
| DIGITE: 'C' ou a paravra controller para criar um Controller |
| DIGITE: 'M' ou a palavra model para criar um Model           | 
| DIGITE: 'sair' para cancelar a operação                      |
----------------------------------------------------------------\r\n";
echo "Aguardando a opção escolhida... \r\n";
$component = fgets(STDIN);
$component = rtrim($component);
if ($component == 'C' or $component == 'c' or $component == 'Controller' or $component == 'controller' or $component == 'Controler' or $component == 'controler') {
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
    exit;
} elseif ($component == 'M' or $component == 'm' or $component == 'Model' or $component == 'model') {
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
    exit;
} elseif ($component == 's' or $component == 'S' or $component == 'sair' or $component == 'Sair') {
    echo "Operação cancelada pelo usuário!\r\n\r\n";
    exit;
} else {
    echo "Opção inválida \r\n\r\n";
    exit;
}
