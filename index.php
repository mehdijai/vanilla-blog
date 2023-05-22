<?php

// use App\Services\Router;

require("app/functions/utils.php");
require("app/services/Router.php");
require("app/services/Database.php");
require("routes/web.php");

// dd($_SERVER);

Router::getInstance()->handle();