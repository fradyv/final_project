<?php

namespace App\Http\Requests\DigitalProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDigitalProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->shop()->exists();
    }

    public function rules(): array
    {
        return [
            'campaign_id'     => ['required', 'integer', Rule::exists('campaigns', 'id')->where('status', 'active')],
            'title'           => ['required', 'string', 'max:150'],
            'description'     => ['nullable', 'string', 'max:5000'],
            'price'           => ['required', 'numeric', 'min:0'],
            'stock'           => ['required', 'integer', 'min:0'],
            'product_preview' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'category'        => ['required', 'string', 'max:100'],
            'file_url'        => ['required', 'file', 'max:51200'],
        ];
    }
}
