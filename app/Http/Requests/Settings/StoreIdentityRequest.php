<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIdentityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null
            && ! $this->user()->identityVerification()->whereIn('status', ['pending', 'approved'])->exists();
    }

    public function rules(): array
    {
        return [
            'legal_name'  => ['required', 'string', 'max:150'],
            'ktp_number'  => ['required', 'string', 'size:16', 'unique:identity_verifications,ktp_number'],
            'ktp_photo'   => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'selfie_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }
}
