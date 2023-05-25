<?php

$router = Router::getInstance();

$router->get("/", "Home");
$router->get("/about", "About");
$router->get("/contact", "Contact");
$router->get("/posts/create", "Post", "create");
$router->post("/posts/create", "Post", "store");
$router->get("/posts/{slug}", "Post", "view");
$router->notFound();
