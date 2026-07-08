<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title'         => ['sometimes', 'required', 'string', 'max:150'],
            'description'   => ['sometimes', 'required', 'string', 'max:5000'],
            'target_amount' => ['sometimes', 'required', 'numeric', 'min:1'],
            'status'        => ['sometimes', Rule::in(['active', 'completed', 'closed'])],
            'end_date'      => ['sometimes', 'required', 'date'],
        ];
    }
}
