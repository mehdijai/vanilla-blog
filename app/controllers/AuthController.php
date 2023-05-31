<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Repositories\AuthRepository;
use Exception;

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
        $data = $_POST;

        $errors = [];

        $validator = new Validator([
            'name' => ['string', 'max:100', 'min:3'],
            'username' => ['string', 'max:100', 'min:3'],
            'email' => ['string', 'max:100', 'min:4', 'email'],
            'password' => ['string', 'min:8', 'upper', 'symbol', 'digit'],
        ]);

        $validator->validate($data);
        if (!$validator->isValid()) {
            $errors = $validator->getMessages();
        } else {
            $data = $validator->validated();
            $data['password'] = password_hash($data["password"], PASSWORD_DEFAULT);
            AuthRepository::store($data);
            $data = [];
            $errors = [];
            unset($_POST);
            header("Location: /posts");
        }

        view("auth.register", [
            'data' => $data,
            'errors' => $errors,
            ...$this->data,
        ]);
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
