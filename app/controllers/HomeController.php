<?php

namespace App\Controllers;

use App\Repositories\PostsRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\CategoriesRepository;

class HomeController extends Controller
{
    public function index()
    {
        $authors = AuthorsRepository::all();
        $posts = PostsRepository::all();
        $categories = CategoriesRepository::all();

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
