<?php

namespace Scooby\Helpers;

class Response
{
     /**
     * Retorna um array json
     *
     * @param string|array $data
     * @return void
     */
    public static function json($data): void
    {
        header('Content-type: application/json');
        echo json_encode($data);
        exit;
    }
}