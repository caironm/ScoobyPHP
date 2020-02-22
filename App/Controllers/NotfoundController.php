<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Helpers\HttpErrorResponse;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        $this->view('error', '404', [
            'code' => HttpErrorResponse::httpGetCodeError(),
            'httpErrorMessage' => HttpErrorResponse::httpGetMsgError(),
        ]);
    }
}
