<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'campaign_id'       => ['required', 'integer', 'exists:campaigns,id'],
            'product_ids'       => ['nullable', 'array'],
            'product_ids.*'     => ['integer', 'exists:products,id'],
            'total_amount'      => ['required', 'numeric', 'min:0'],
            'payment_method_id' => ['nullable', 'integer', 'exists:payment_methods,id'],
            'bank_name'         => ['nullable', 'string', 'max:100'],
        ];
    }
}
