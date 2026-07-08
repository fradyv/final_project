<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EnsureFundraiserApproved;
use App\Http\Middleware\EnsurePenggalang;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // Override alias 'auth' dengan custom Authenticate agar
            // redirectTo() selalu null → tidak mencari route 'login'.
            'auth'                => Authenticate::class,
            'role'                => CheckRole::class,
            'fundraiser.approved' => EnsureFundraiserApproved::class,
            'penggalang'          => EnsurePenggalang::class,
        ]);


        // Kecualikan SEMUA route dari validasi CSRF token.
        // Alasan: aplikasi ini adalah REST API murni yang diakses via Postman /
        // frontend SPA — bukan form HTML tradisional.
        // CSRF protection dirancang untuk mencegah serangan dari BROWSER
        // (tab lain yang diam-diam submit form). Postman & API client
        // tidak bisa di-exploit dengan cara tersebut.
        // Keamanan tetap terjaga melalui:
        //   - Session cookie (hanya dikirim setelah login berhasil)
        //   - Middleware 'auth' (route protected hanya bisa diakses yg sudah login)
        //   - Middleware 'role:*' (pembatasan akses berdasarkan role)
        $middleware->validateCsrfTokens(except: ['*']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Middleware 'auth' melempar AuthenticationException saat user belum login.
        // Default Laravel: redirect ke route bernama 'login' (untuk web form).
        // Karena ini REST API tanpa halaman login HTML, route 'login' tidak ada
        // → error "Route [login] not defined."
        //
        // Solusi: tangkap AuthenticationException dan langsung kembalikan JSON 401.
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {
            return response()->json([
                'message' => 'Unauthenticated. Silakan login terlebih dahulu.',
            ], 401);
        });
    })->create();
