<?php

namespace App\Models;

use App\Enums\FundraiserStatus;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    protected $table = 'fundraiser';

    protected $fillable = [
        'user_id',
        'ktp_number',
        'ktp_photo',
        'selfieandktp_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'passbook_photo',
        'statement_letter',
        'other_docs',
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
}
