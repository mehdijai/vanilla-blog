<?php

class PostController extends Controller
{
    public function view()
    {
        extract($this->data);
        require("views/post.view.php");
    }
    public function create()
    {
        extract($this->data);
        require("views/create-post.view.php");
    }
}
