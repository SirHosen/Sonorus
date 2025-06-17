<?php
// app/Http/Middleware/CheckRole.php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        // Check if user has any roles
        if (Auth::user()->roles->isEmpty()) {
            // Assign 'user' role if no role is assigned
            Auth::user()->assignRole('user');
            
            // Then redirect to player area
            return redirect('/player');
        }

        if (Auth::user()->hasRole($role)) {
            return $next($request);
        }

        if (Auth::user()->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if (Auth::user()->hasRole('user')) {
            return redirect('/player');
        }

        // Fallback redirect
        return redirect('/');
    }
}
