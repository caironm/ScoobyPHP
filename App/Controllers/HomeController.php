<?php

namespace Controllers;

use \Core\Controller;
use Helpers\FlashMessage;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
        $this->Load('pages', 'Home', [
            'wellcomeMessage' => 'Bem vindo ao Scooby framework. Se Você esta visualizando esta página, quer dizer que o scooby foi instalado corretamente!'
        ]);
    }
}
