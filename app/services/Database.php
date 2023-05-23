<?php

class Database
{
    private PDO $pdo;
    private PDOStatement $statement;

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
        if(!$result){
            abort(404);
        }
    }
    public function all()
    {
        return $this->statement->fetchAll();
    }
}
