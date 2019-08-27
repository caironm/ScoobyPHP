<?php

namespace Controllers;
use \Core\Controller;
use Helpers\Cookie;
//uses para user a classe illuminate database
use Illuminate\Database\Capsule\Manager as db;
//use para o pdo
use PDO;
//use para a classe helper que é uma factory para as outras classes
use Helpers\Helper;
use Helpers\Session;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
       
        $helper = new Helper;
        
        /**
         *
         * Exemplo de consulta usando o helper IlluminateDatabase
         *
         */

        // $conn = $helper->illuminateDb();
        // $user = db::table('users')->where(['id' => 55])->get();
        // foreach($user as $user){
        //     var_dump($user->email);
        // }



        /**
         * 
         * Exemplo de consulta usando o helper PDODatabase
         * 
         */
        // $pdo = $helper->pdoDb();
        // $sql = "SELECT * from users WHERE id = 55";
        // $stmt = $pdo->db->prepare($sql);
        // $stmt->execute();
        // $user = $stmt->fetch();
        // var_dump($user['email']);


        $this->Load('pages', 'Home', [
            'wellcomeMessage' => 'Bem vindo ao Scooby framework. Se Você esta visualizando esta página, quer dizer que o scooby foi instalado corretamente!'
        ]);
    }
}
