<?php

namespace Scooby\Helpers;

class Debug
{
    /**
     * Grava um arquivo de debug em App/tmp com o nome do arquivo informado
     * caso nenhum nome seja informado o debug será gravado em debug.log
     *
     * @param mixed $data
     * @param string $msg
     * @param string $path
     * @return void
     */
    public static function debug($data, string $msg = '', string $logName = 'debug.log')
    {
        if (!file_exists('App/Logs/' . $logName)) {
            touch('App/Logs/' . $logName, 0777, true);
        }
        if (empty($msg)) {
            $msg = 'Não Informado';
        }
        file_put_contents('App/Logs/'.$logName, "Log criado em - " . date('Y-m-d H:i:s'). "\n\nObs: " . $msg . "\n\n" . print_r($data, true) . "\n End Log \n------------------------------------------------------------------------------------------- \n\n", FILE_APPEND);
    }
}