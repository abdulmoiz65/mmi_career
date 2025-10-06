<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if admin is logged in
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login'); // redirect to admin login if not authenticated
        }

        return $next($request);
    }
}
