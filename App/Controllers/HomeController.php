<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Helpers\Response;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        if (IS_API == 'true') {
            Response::Json(['Wellcome' => $GLOBALS['WELLCOME_MSG']]);
        }
        $this->setTitle('Wellcome');
        $this->view('Pages', 'home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }
}
