<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin')->check() && auth('admin')->user()->role === 'super_admin') {
            return $next($request);
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('error', 'Unauthorized access. Only Super Admins can perform this action.');
    }
}
