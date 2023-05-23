<?php
// namespace Routes;

// use App\Services\Router;

$router = Router::getInstance();

$router->get("/", "Home");
$router->get("/posts/create", "Post", "create");
$router->get("/about", "About");
$router->get("/contact", "Contact");
$router->get("/{slug}", "Post", "view");