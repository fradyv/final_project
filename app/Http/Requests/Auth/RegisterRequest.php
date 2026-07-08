<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi data registrasi akun baru.
 *
 * Semua aturan dijalankan server-side sebelum controller menyentuh data,
 * sehingga input yang tidak valid / berbahaya tidak pernah sampai ke lapisan database.
 *
 * Field:
 *  - name             : nama lengkap pengguna (wajib, maks 150 karakter)
 *  - email            : email unik (wajib, format email, maks 150 karakter)
 *  - password         : kata sandi (wajib, min 8 karakter, harus dikonfirmasi)
 *  - password_confirmation : konfirmasi password (divalidasi otomatis via 'confirmed')
 *  - phone_number     : nomor telepon (opsional, maks 20 karakter)
 *  - address          : alamat lengkap (opsional, maks 500 karakter)
 */
class RegisterRequest extends FormRequest
{
    /** Siapapun boleh mencoba registrasi. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:150'],
            'email'         => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number'  => ['nullable', 'string', 'max:20'],
            'address'       => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
        ];
    }
}
