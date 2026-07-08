<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $user = $this->user();

        $rules = [
            'display_name'       => ['required', 'string', 'max:100'],
            'bio'                => ['nullable', 'string', 'max:1000'],
            'donate_anonymously' => ['sometimes', 'boolean'],
            'profile_photo'      => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];

        if (! $user->isLegalNameLocked()) {
            $rules['legal_name'] = ['nullable', 'string', 'max:150'];
        }

        return $rules;
    }
}
