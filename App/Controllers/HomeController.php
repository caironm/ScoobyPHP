<?php

namespace Controllers;

use \Core\Controller;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        $this->view('pages', 'Home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }
}
