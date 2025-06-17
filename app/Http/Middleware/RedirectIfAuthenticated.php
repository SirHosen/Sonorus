<?php
// app/Http/Middleware/RedirectIfAuthenticated.php


namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Don't redirect to HOME, which is /redirect
                // Only redirect if the requested URL is login or register
                if ($request->is('login') || $request->is('register')) {
                    return redirect()->route('redirect');
                }
            }
        }

        return $next($request);
    }
}
