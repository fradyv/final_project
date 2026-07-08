<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserNotificationPreference;
use App\Models\UserPrivacySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name'         => $validated['name'],
                'display_name' => $validated['name'],
                'email'        => $validated['email'],
                'password'     => $validated['password'],
                'phone_number' => $validated['phone_number'] ?? null,
                'address'      => $validated['address'] ?? null,
                'is_active'    => true,
            ]);

            $userRole = Role::firstOrCreate(['name' => 'user']);
            $user->roles()->attach($userRole->id);

            UserNotificationPreference::create(['user_id' => $user->id]);
            UserPrivacySetting::create(['user_id' => $user->id]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt([
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
        ])) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();

            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda telah dinonaktifkan.']);
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load('roles', 'fundraiser.wallet'),
        ]);
    }
}
