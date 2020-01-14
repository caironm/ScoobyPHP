<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index($data): void
    {
        $this->view('error', '404', ['code' => $data['errcode']]);
    }
}
