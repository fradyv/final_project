<?php

namespace App\Http\Requests\Donation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * A donation is funded from the donor's wallet balance (earnings from
 * selling digital products) rather than real cash - see DonationController.
 */
class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'campaign_id' => ['required', 'integer', 'exists:campaigns,id'],
            'amount'      => ['required', 'numeric', 'min:1000'],
        ];
    }
}
