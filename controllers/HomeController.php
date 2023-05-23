<?php

class HomeController extends Controller
{
    public function index()
    {
        $db = new Database();

        $authors = AuthorsRepository::all($db);

        $posts = PostsRepository::all($db);

        $categories = CategoriesRepository::all($db);

        extract($this->data);
        require("views/home.view.php");
    }
}
