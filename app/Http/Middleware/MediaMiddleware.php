<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class MediaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->role;
        if ($role == 'admin' || $role == 'media') {
            return $next($request);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
