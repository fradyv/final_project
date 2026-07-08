<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPrivacySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'share_activity',
        'marketing_consent',
        'show_profile_publicly',
    ];

    protected function casts(): array
    {
        return [
            'share_activity'       => 'boolean',
            'marketing_consent'    => 'boolean',
            'show_profile_publicly' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
