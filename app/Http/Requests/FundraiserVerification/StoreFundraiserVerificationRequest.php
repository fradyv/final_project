<?php

namespace App\Http\Requests\FundraiserVerification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFundraiserVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()
            && ! $this->user()->fundraiser()->whereIn('status', ['pending', 'approved'])->exists();
    }

    public function rules(): array
    {
        return [
            'ktp_number'           => ['required', 'string', 'size:16', 'unique:fundraisers,ktp_number'],
            'ktp_photo'            => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'selfie_and_ktp_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'bank_name'            => ['required', 'string', 'max:100'],
            'bank_account_number'  => ['required', 'digits_between:8,20'],
            'bank_account_name'    => ['required', 'string', 'max:150'],
            'statement_letter'     => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'other_documents'      => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }
}
