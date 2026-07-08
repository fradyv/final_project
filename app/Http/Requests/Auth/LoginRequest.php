<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi data login.
 *
 * Hanya membutuhkan email dan password.
 * Throttle (rate-limiting) diterapkan di level route, bukan di sini.
 *
 * Field:
 *  - email    : email yang sudah terdaftar (wajib, format email)
 *  - password : kata sandi (wajib)
 */
class LoginRequest extends FormRequest
{
    /** Siapapun (termasuk tamu) boleh mencoba login. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ];
    }
}
