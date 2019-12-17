<?php

namespace Controllers;

use \Core\Controller;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index($data): void
    {
        $this->Load('error', '404', ['code' => $data['errcode']]);
    }
}
