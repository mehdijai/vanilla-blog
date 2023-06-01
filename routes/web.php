<?php

namespace Routes;

use App\Core\Router;

$router = Router::getInstance();

$router->get("/", "Home");
$router->get("/about", "About");
$router->get("/contact", "Contact");
$router->get("/posts", "Post", "index");
$router->delete("/posts", "Post", "destroy");
$router->put("/posts", "Post", "updateDraftState");
$router->get("/posts/create", "Post", "create");
$router->post("/posts/create", "Post", "store");
$router->patch("/posts/update", "Post", "edit");
$router->get("/posts/update/{slug}", "Post", "update");
$router->get("/posts/{slug}", "Post", "view");

$router->get("/auth/login", "Auth", "login");
$router->post("/auth/login", "Auth", "authenticate");
$router->get("/auth/profile", "Auth", "show");
$router->get("/auth/register", "Auth", "create");
$router->post("/auth/register", "Auth", "store");

$router->notFound();
