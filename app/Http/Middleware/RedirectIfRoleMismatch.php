<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfRoleMismatch
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
}