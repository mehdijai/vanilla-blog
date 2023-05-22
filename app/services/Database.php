<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $config = require("app/config/database.php");

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
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }
}
