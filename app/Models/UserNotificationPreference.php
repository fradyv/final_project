<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_program_updates',
        'email_donations',
        'email_purchases',
        'push_enabled',
    ];

    protected function casts(): array
    {
        return [
            'email_program_updates' => 'boolean',
            'email_donations'       => 'boolean',
            'email_purchases'       => 'boolean',
            'push_enabled'          => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
