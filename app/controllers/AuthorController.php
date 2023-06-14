<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Repositories\PostsRepository;
use App\Repositories\AuthorsRepository;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = AuthorsRepository::all();

        view("authors.index", [
            ...compact(
                "authors",
            ),
            ...$this->data
        ]);
    }

    public function view()
    {
        $username = $this->data['params']['username'];

        $author = AuthorsRepository::get($username);

        view("authors.author", [
            ...compact(
                "author",
            ),
            ...$this->data
        ]);
    }

    public function list_posts()
    {
        $user = Auth::user();
        if ($user == null) {
            // TODO: Use 401 Instead of 404
            abort(404);
        }

        $posts = PostsRepository::allByAuthors($user['username']);

        view("authors.author-posts", [
            ...compact(
                "posts",
            ),
            ...$this->data
        ]);
    }

    public function view_post()
    {
        $slug = $this->data['params']['slug'];

        $user = Auth::user();
        if ($user == null) {
            // TODO: Use 401 Instead of 404
            abort(404);
        }

        $id = (int)$user['id'];

        $post = PostsRepository::getByAuthor($slug, $id);

        view("authors.author-post", [
            ...compact(
                "post",
            ),
            ...$this->data
        ]);
    }
}
