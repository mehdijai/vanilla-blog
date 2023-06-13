<?php

namespace App;

use App\Core\App;
use App\Core\Container;
use App\Core\Database;

session_start();

$container = new Container();

App::setContainer($container);

App::bind(Database::class, function () {
    return new Database();
});
