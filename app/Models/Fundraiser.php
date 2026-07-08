<?php

namespace App\Models;

use App\Enums\FundraiserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ktp_number',
        'ktp_photo',
        'selfie_and_ktp_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'statement_letter',
        'other_documents',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => FundraiserStatus::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
}
