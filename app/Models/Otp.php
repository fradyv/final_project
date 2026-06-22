<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Otp extends Model
{
    protected $table = 'otp';

    protected $fillable = [
        'user_id',
        'otp_code',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
