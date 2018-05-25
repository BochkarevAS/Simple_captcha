<?php

namespace App\Core;

class Db
{
    private $connection;

    public function __construct()
    {
        $dbConfig = include(ROOT . '/config/db_config.php');
        $host = $dbConfig['host'];
        $dbname = $dbConfig['dbname'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];
        $this->connection = new \PDO("mysql:dbname=$dbname;host=$host", $user, $password);
    }

    public function query($sql, $params = [])
    {
        $db = $this->connection;
        $result = $db->prepare($sql);
        $result->execute($params);
        return $result;
    }
}