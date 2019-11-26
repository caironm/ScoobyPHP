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
    public function index()
    {
        $this->Load('pages', 'Home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }
}
