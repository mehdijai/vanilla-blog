<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Database;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    // Render Login Page
    public function login()
    {
        view("auth.login");
    }

    // Login User
    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        Auth::login($email, $password);
    }

    // Render Create New User Page
    public function create()
    {
        view("auth.register");
    }

    // Register New User
    public function store()
    {
        $user = new User();
        $user->email = $_POST['email'];
        $user->name = $_POST['name'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        Auth::register($user);
    }

    // Render Author Profile Page
    public function show()
    {
        $id = Session::get('user')['id'] ?? null;
        if ($id == null) {
            abort(404);
        }

        $db = App::resolve(Database::class);
        $user = $db->query("select * from authors where id = :id", compact('id'))->find();

        if ($user == null) {
            abort(404);
        }
        $user = array_diff_key($user, array_flip(User::$casts));
        view("auth.profile", compact('user'));
    }

    // Update Author Settings
    public function update()
    {
        dd("Update");
    }

    public function logout()
    {
        Auth::logout();
    }
}
