<?php

namespace App\Core\Middleware;

use App\Core\Auth;
use App\Core\Contracts\Middleware;

class AuthMiddleware implements Middleware
{
    public function handle()
    {
        if (Auth::user() == null) {
            header("location: /");
            exit();
        }
    }
}
