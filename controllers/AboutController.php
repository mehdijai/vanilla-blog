<?php

class AboutController extends Controller
{
    public function index()
    {
        extract($this->data);
        require("views/about.view.php");
    }
}
