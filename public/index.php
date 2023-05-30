<?php

const BASE_PATH = __DIR__ . '/../';
const PUBLIC_PATH = __DIR__;
require BASE_PATH . "app/functions/utils.php";

spl_autoload_register(function($class){
    require base_path(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

require base_path("routes/web.php");
