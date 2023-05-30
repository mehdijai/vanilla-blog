<?php

namespace App\Controllers;


class AuthController extends Controller
{
    // Render Login Page
    public function login()
    {
        view("auth.login");
    }

    // Login User
    public function Authenticate()
    {
        dd("Login");
    }

    // Render Create New User Page
    public function create()
    {
        view("auth.register");
    }

    // Register New User
    public function store()
    {
        dd("Register");
    }

    // Render Author Profile Page
    public function show()
    {
        view("auth.profile");
    }

    // Update Author Settings
    public function update()
    {
        dd("Update");
    }
}
