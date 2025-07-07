<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Log1Middleware {
    public function handle(Request $request, Closure $next){
        echo 'Log 1 Middle ware';
        return $next($request);
    }
}