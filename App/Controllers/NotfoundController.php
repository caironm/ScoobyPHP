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
        $this->view('Error', '404', [
            'httpErrorCode' => HttpErrorResponse::httpGetErrorCode(),
            'httpErrorMessage' => HttpErrorResponse::httpGetErrorMsg(),
        ]);
    }
}
