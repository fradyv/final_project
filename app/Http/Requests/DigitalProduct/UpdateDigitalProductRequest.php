<?php

namespace App\Http\Requests\DigitalProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDigitalProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->shop()->exists();
    }

    public function rules(): array
    {
        return [
            'campaign_id'     => ['sometimes', 'integer', Rule::exists('campaigns', 'id')->where('status', 'active')],
            'title'           => ['sometimes', 'string', 'max:150'],
            'description'     => ['sometimes', 'nullable', 'string', 'max:5000'],
            'price'           => ['sometimes', 'numeric', 'min:0'],
            'stock'           => ['sometimes', 'integer', 'min:0'],
            'product_preview' => ['sometimes', 'nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'category'        => ['sometimes', 'string', 'max:100'],
            'file_url'        => ['sometimes', 'nullable', 'file', 'max:51200'],
        ];
    }
}
