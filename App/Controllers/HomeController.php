<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Illuminate\Support\Facades\Redis;

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
