<?php

namespace Controllers;
use \Core\Controller;
use Helpers\Redirect;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index()
    {
        $this->Load('error', '404');
    }
}