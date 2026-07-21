<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgCustomerRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->roles->first()->name ?? null;

        if (!in_array($userRole, ['organization_admin', 'customer']) || $userRole !== $role) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}