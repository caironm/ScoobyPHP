<?php

namespace Controllers;

use \Core\Controller;

class FailureController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
        $this->Load('error', 'Failure');
    }
}
