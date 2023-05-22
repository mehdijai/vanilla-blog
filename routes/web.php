<?php
// namespace Routes;

// use App\Services\Router;

$router = Router::getInstance();

$router->get("/{id}", "Post");
$router->get("/", "Home");
$router->get("/about", "About");
$router->get("/contact", "Contact");