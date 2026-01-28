<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Session expired. Please login again.');
        }

        // Check if user has required role
        if (!in_array(Auth::user()->roles, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
