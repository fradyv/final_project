<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Guards routes that create/manage campaigns.
 * A user may only open a fundraising campaign after their
 * fundraiser_verifications record has status = "approved".
 */
class EnsureFundraiserApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Unauthenticated.');
        }

        if (! $user->isFundraiserApproved()) {
            abort(403, 'Akun Anda belum terverifikasi sebagai penggalang dana.');
        }

        return $next($request);
    }
}
