<?php

namespace App\Repositories;

use App\Core\Database;

class Repository
{
    protected static function db()
    {
        return new Database();
    }
}
