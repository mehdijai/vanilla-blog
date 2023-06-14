<?php

namespace App\Repositories;

use App\Core\App;
use App\Core\Database;

class Repository
{
    protected static function db(): Database
    {
        return App::resolve(Database::class);
    }
}
