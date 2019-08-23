<?php

namespace Core;
use Illuminate\Database\Capsule\Manager as db;

class Model
{

    /**
     * Metodo construtor da classe
     */
    public function __construct()
    {
        require_once 'Config/illuminateConfig.php';
        require_once 'Config/PDOConfig';
    }
}