<?php

namespace App\Core;

use PDO;
use PDOStatement;

class Database
{
    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct()
    {
        $config = config("database");

        $connection_string = $config['db'] . ":" . http_build_query($config, '', ';');

        try {
            $this->pdo = new PDO(
                $connection_string,
                options: [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function query(string $query, $params = [])
    {
        $this->statement = $this->pdo->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }
    public function findOrFail()
    {
        $result = $this->statement->fetch();
        if ($result == null || $result['id'] == null) {
            abort(404);
        }
        return $result;
    }
    public function all()
    {
        return $this->statement->fetchAll();
    }
}
