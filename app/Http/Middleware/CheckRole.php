<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Role-based authorization middleware.
 * Usage in routes: ->middleware('role:admin') or ->middleware('role:admin,penggalang')
 * Allows access if the authenticated user holds ANY of the listed roles.
 * Uses User::hasRole() which runs a single indexed EXISTS query (no N+1).
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Unauthenticated.');
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki izin untuk mengakses resource ini.');
    }
}
