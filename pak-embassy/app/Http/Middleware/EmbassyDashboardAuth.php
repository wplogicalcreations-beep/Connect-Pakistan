<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmbassyDashboardAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('dashboard.loginForm');
        }
        $userRole = Auth::user()->roles->first()->name ?? null;
        if (in_array($userRole, ['organization_admin', 'customer'])) {
            return redirect()->route('dashboard.loginForm');
        }

        return $next($request);
    }
}