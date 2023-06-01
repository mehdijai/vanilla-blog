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
            $data['password'] = password_hash($data["password"], PASSWORD_DEFAULT);
            $id = AuthRepository::store($data);
            $data['id'] = $id;
            $data['profile_picture'] = App::resolve(Database::class)->query("select profile_picture from authors where id = :id", compact('id'))->find()['profile_picture'];

            Session::set('user', array_diff_key($data, array_flip($user->casts)));
            unset($_POST);
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
    public static function me($id)
    {
        $user = static::user();
        if ($user == null) {
            return false;
        }
        return $user['id'] == $id;
    }
}
