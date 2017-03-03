<?php

namespace Hasnayeen\Tasque;

use PDO;

class DatabaseAdapter
{
    protected $connection;
    
    function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll($tableName)
    {
        return $this->connection->query("select * from " . $tableName)->fetchAll();
    }

    public function fetch($sql, $value)
    {
        $db = $this->connection->prepare($sql);
        $db->execute($value);
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query($sql, $parameters)
    {
        return $this->connection->prepare($sql)->execute($parameters);
    }
}