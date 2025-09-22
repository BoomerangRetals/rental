<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();
    Log::info('DEBUG: RoleMiddleware', [
            'user' => $user ? $user->email : null,
            'user_role' => $user ? $user->role : null,
            'required_role' => $role,
            'url' => $request->fullUrl(),
        ]);
        if (!$user || $user->role !== $role) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
