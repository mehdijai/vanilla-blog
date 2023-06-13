<?php

namespace App;

use App\Core\App;
use App\Core\Container;
use App\Core\Database;
use App\Core\Session;

session_start();

$container = new Container();

App::setContainer($container);

App::bind(Database::class, function () {
    return new Database();
});

Session::set("user_id", 1);
