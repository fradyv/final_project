<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacySettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'share_activity'        => ['sometimes', 'boolean'],
            'marketing_consent'     => ['sometimes', 'boolean'],
            'show_profile_publicly' => ['sometimes', 'boolean'],
        ];
    }
}
