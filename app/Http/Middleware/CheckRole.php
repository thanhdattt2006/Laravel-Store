<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $roleId)
    {
        if (!Auth::check()) {
            return redirect('/account');
        }

        if (Auth::user()->role_id != $roleId) {
            return abort(403, 'Access denied: You do not have the required role.');
        }

        return $next($request);
    }
}