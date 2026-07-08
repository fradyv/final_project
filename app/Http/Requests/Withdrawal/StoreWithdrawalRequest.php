<?php

namespace App\Http\Requests\Withdrawal;

use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isPenggalang() ?? false;
    }

    public function rules(): array
    {
        return [
            'campaign_id'         => ['required', 'integer', 'exists:campaigns,id'],
            'amount'              => ['required', 'numeric', 'min:10000'],
            'bank_name'           => ['required', 'string', 'max:100'],
            'bank_account_number' => ['required', 'string', 'max:30'],
            'bank_account_name'   => ['required', 'string', 'max:150'],
        ];
    }
}
