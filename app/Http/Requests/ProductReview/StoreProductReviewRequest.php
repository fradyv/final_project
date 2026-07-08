<?php

namespace App\Http\Requests\ProductReview;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'rating'     => ['required', 'integer', 'between:1,5'],
            // strip_tags-friendly free text; escaped automatically wherever it is
            // later rendered through Blade ({{ }}), preventing stored XSS.
            'comment'    => ['nullable', 'string', 'max:1000'],
        ];
    }
}
