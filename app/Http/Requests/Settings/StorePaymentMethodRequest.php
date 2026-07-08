<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'type'               => ['required', Rule::in(['bank', 'ewallet', 'card'])],
            'label'              => ['required', 'string', 'max:100'],
            'provider'           => ['required', 'string', 'max:100'],
            'account_reference'  => ['required', 'string', 'max:100'],
            'last_four'          => ['nullable', 'string', 'size:4'],
            'is_default'         => ['sometimes', 'boolean'],
        ];
    }
}
