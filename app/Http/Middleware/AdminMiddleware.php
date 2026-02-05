<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // belum login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // bukan admin
        if (Auth::user()->isadmin != 1) {
            Auth::logout();
            return redirect('/login');
        }

        return $next($request);
    }
}
