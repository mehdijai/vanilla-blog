<?php

namespace Routes;

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\AboutController;
use App\Controllers\AuthorController;
use App\Controllers\ContactController;

$router = Router::getInstance();

// Static Pages
$router->get("/", HomeController::class);
$router->get("/about", AboutController::class);
$router->get("/contact", ContactController::class);

// Posts
$router->get("/posts", PostController::class);
$router->delete("/posts", PostController::class, "destroy")->middleware(['auth']);
$router->put("/posts", PostController::class, "updateDraftState")->middleware(['auth']);
$router->get("/posts/create", PostController::class, "create")->middleware(['auth']);
$router->post("/posts/create", PostController::class, "store")->middleware(['auth']);
$router->patch("/posts/update", PostController::class, "edit")->middleware(['auth']);
$router->get("/posts/update/{slug}", PostController::class, "update")->middleware(['auth']);
$router->get("/posts/{slug}", PostController::class, "view");

// Author
$router->get("/authors", AuthorController::class);
$router->get("/authors/posts", AuthorController::class, "list_posts")->middleware(['auth']);
$router->get("/authors/posts/{slug}", AuthorController::class, "view_post")->middleware(['auth']);
$router->get("/authors/{username}", AuthorController::class, "view");

// Auth
$router->get("/auth/login", AuthController::class, "login")->middleware(['guest']);
$router->post("/auth/login", AuthController::class, "authenticate")->middleware(['guest']);
$router->post("/auth/logout", AuthController::class, "logout")->middleware(['auth']);
$router->get("/auth/profile", AuthController::class, "show")->middleware(['auth']);
$router->get("/auth/register", AuthController::class, "create")->middleware(['guest']);
$router->post("/auth/register", AuthController::class, "store")->middleware(['guest']);

$router->route();
