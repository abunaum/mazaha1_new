<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role !== 'admin'){
            return redirect()->route('dashboard');
        } else {
            return $next($request);
        }
    }
}
