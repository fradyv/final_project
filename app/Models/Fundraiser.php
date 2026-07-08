<?php

namespace App\Models;

use App\Enums\FundraiserStatus;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
<<<<<<< HEAD
    protected $table = 'fundraiser';
=======
    use HasFactory;
>>>>>>> master

    protected $fillable = [
        'user_id',
        'ktp_number',
        'ktp_photo',
<<<<<<< HEAD
        'selfieandktp_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'passbook_photo',
        'statement_letter',
        'other_docs',
=======
        'selfie_and_ktp_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'statement_letter',
        'other_documents',
>>>>>>> master
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
<<<<<<< HEAD
=======

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
>>>>>>> master
}
