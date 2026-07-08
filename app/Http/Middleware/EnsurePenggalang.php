<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePenggalang
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || ! $user->isPenggalang()) {
            abort(403, 'Fitur ini hanya untuk penggalang dana terverifikasi.');
        }

        return $next($request);
    }
}
