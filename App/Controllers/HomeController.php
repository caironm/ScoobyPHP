<?php

namespace Scooby\Controllers;

use Scooby\Helpers\Redirect;

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
            $this->Json(['Wellcome' => $GLOBALS['WELLCOME_MSG']]);
        }
        $this->setTitle('ScoobyTasks');
        $this->view('Pages', 'home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function back(): void
    {
        Redirect::redirectBack(-2);
    }
}
