<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationStep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredStep): Response
    {
          $user = User::find($request->user_id); // from {user} in route

        if (!$user) {
            abort(404, 'User not found');
        }

        if ((int) $user->registration_step < (int) $requiredStep - 1) {
            return response()->json([
                'message' => 'You must complete previous steps first.'
            ], 403);
        }

        return $next($request);
    }
}
