<?php

namespace App\Core\Middleware;

use App\Core\Auth;
use App\Core\Contracts\Middleware;

class GuestMiddleware implements Middleware
{
    public function handle()
    {
        if (Auth::user() != null) {
            header("location: " . HOMEPAGE);
            exit();
        }
    }
}
