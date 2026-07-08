<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationPreferencesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'email_program_updates' => ['sometimes', 'boolean'],
            'email_donations'       => ['sometimes', 'boolean'],
            'email_purchases'       => ['sometimes', 'boolean'],
            'push_enabled'          => ['sometimes', 'boolean'],
        ];
    }
}
