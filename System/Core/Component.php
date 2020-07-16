<?php

namespace Scooby\Core;

use Scooby\Helpers\Debug;

abstract class Component
{
    /**
     * Cria um arquivo de debug
     *
     * @param mixed $data
     * @param string $msg
     * @param string $logName
     * @return void
     */
    public function debug($data, $msg = '', $logName = 'debug.log')
    {
        Debug::debug($data, $msg, $logName);
    }
}