<?php

namespace App\Core;

use App\Models\User;
use App\Repositories\AuthRepository;

class Auth
{
    protected const LOGIN_PAGE = "/auth/login";
    protected const REGISTER_PAGE = "/auth/register";
    protected const PROFILE_PAGE = "/auth/profile";

    public static function register(User $user)
    {
        $errors = [];
        $data = $user->toArray();

        // TODO: Validate inputs
        $validator = new Validator([
            'name' => ['string', 'max:100', 'min:3'],
            'username' => ['string', 'max:100', 'min:3'],
            'email' => ['string', 'max:100', 'min:4', 'email', 'unique:authors,email'],
            'password' => ['string', 'min:8', 'upper', 'symbol', 'digit'],
        ]);

        $validator->validate($data);
        if (!$validator->isValid()) {
            $errors = $validator->getMessages();
        } else {
            $data = $validator->validated();
            // TODO: Hash password
            $data['password'] = password_hash($data["password"], PASSWORD_DEFAULT);
            // TODO: Store the user
            $id = AuthRepository::store($data);
            $data['id'] = $id;
            // TODO: Save the user to session
            Session::set('user', array_diff_key($data, array_flip($user->casts)));
            // TODO: Unset post
            unset($_POST);
            // TODO: Redirect to profile
            header("Location: " . self::PROFILE_PAGE);
            exit();
        }

        view("auth.register", [
            'data' => $data,
            'errors' => $errors,
        ]);
    }
    public static function login(string $email, string $password)
    {
    }
    public static function logout()
    {
    }
    public static function user()
    {
        return Session::get("user");
    }
}
