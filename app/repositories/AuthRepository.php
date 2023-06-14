<?php

namespace App\Repositories;

class AuthRepository extends Repository
{

    public static function store(array $data)
    {
        $query = 'insert into authors 
                (name, username, email, password) 
                values 
                (:name, :username, :email, :password);';

        return self::db()->query($query, $data)->lastInsertId();
    }
}
