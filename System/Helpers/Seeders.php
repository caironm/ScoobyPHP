<?php

namespace Scooby\Helpers;

use PDO;

class Seeders
{
    /**
     * Roda uma seed semeando o banco de dados com dados fakes
     *
     * @param string $table
     * @param array $arr
     * @return string|bool
     */
    public function Seed($table, $arr = [])
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            return ("ERROR: Um erro desconhecido ocorreu.");
        }
        require_once '../../../App/Config/env.php';
        require_once '../../../App/Config/databaseConfig.php';
        $conn = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        $fieldsList = '';
        $valuesList = '';
        $sql = "insert into ".$table." (";
        foreach ($arr as $field => $value) {
            $fieldsList .= "$field,";
            $valuesList .= "'$value',";
        }
        $fieldsList = substr($fieldsList, 0, -1);
        $valuesList = substr($valuesList, 0, -1);
        $sql .= $fieldsList.") values (".$valuesList.")";
        if (!$conn->query($sql)) {
            return false;
        }
        return true;
    }
}
