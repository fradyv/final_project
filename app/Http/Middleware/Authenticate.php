<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * Override middleware 'auth' bawaan Laravel.
 *
 * Untuk request HTML/browser (expects HTML): redirect ke halaman login.
 * Untuk request API (expects JSON):           return null → 401 JSON.
 */
class Authenticate extends Middleware
{
    /**
     * Jika request mengharapkan JSON (API client) → return null (401).
     * Jika request dari browser → redirect ke halaman login.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
