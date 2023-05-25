<?php

namespace Controllers;

use App\Core\Database;
use Controllers\Controller;
use App\Repositories\PostsRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\CategoriesRepository;

class HomeController extends Controller
{
    public function index()
    {
        $db = new Database();

        $authors = AuthorsRepository::all($db);

        $posts = PostsRepository::all($db);

        $categories = CategoriesRepository::all($db);

        view("home", [
            ...compact(
                "authors",
                "posts",
                "categories",
            ),
            ...$this->data
        ]);
    }
}
