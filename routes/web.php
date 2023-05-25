<?php

namespace Routes;

use App\Core\Router;

$router = Router::getInstance();

$router->get("/", "Home");
$router->get("/about", "About");
$router->get("/contact", "Contact");
$router->get("/posts", "Post", "index");
$router->delete("/posts", "Post", "destroy");
$router->get("/posts/create", "Post", "create");
$router->post("/posts/create", "Post", "store");
$router->get("/posts/{slug}", "Post", "view");
$router->notFound();
