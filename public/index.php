<?php


// ---- BEGIN:CONSTANTS ----

const BASE_PATH = __DIR__ . '/../';
const PUBLIC_PATH = __DIR__;

const HOMEPAGE = "/";
const LOGIN_PAGE = "/auth/login";
const REGISTER_PAGE = "/auth/register";
const PROFILE_PAGE = "/auth/profile";

// ---- END:CONSTANTS ----

require BASE_PATH . "app/functions/utils.php";

spl_autoload_register(function($class){
    require base_path(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

require BASE_PATH . "app/bootstrap.php";
require base_path("routes/web.php");
