<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        $this->view('Pages', 'Home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }

    public function teste() {
        echo 'teste aqui a rota com nome teste funciona';
    }
}
