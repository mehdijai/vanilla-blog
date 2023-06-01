<?php

namespace App\Models;

class User
{
    public string $email;
    public string $name;
    public string $username;
    public string $password;

    public function toArray()
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    public $casts = [
        'password'
    ];
}
