<?php

$db = new Database();

$authors = AuthorsRepository::all($db);

$posts = PostsRepository::all($db);

$categories = CategoriesRepository::all($db);

require("views/home.view.php");
