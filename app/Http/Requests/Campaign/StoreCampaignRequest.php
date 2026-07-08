<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Route-level 'fundraiser.approved' middleware already blocks non-approved
        // users; this is a defensive second check.
        return $this->user() && $this->user()->isFundraiserApproved();
    }

    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:150'],
            'description'   => ['required', 'string', 'max:5000'],
            'target_amount' => ['required', 'numeric', 'min:1'],
            'end_date'      => ['required', 'date', 'after:today'],
        ];
    }
}
