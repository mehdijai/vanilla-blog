<?php

namespace App\Controllers;

use App\Core\Middleware\Middleware;

class AboutController extends Controller
{
    public function index()
    {
        view("about");
    }
}
